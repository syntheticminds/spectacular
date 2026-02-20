<?php

namespace Spectacular\Core\Http\Controllers\Api;

use Spectacular\Core\Http\Controllers\Controller;
use Spectacular\Core\Http\Resources\ProjectResource;
use Spectacular\Core\Http\Requests\OrganiseProjectRequest;
use Spectacular\Core\Http\Requests\StoreProjectRequest;
use Spectacular\Core\Http\Requests\UpdateProjectRequest;
use Spectacular\Core\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\DB;

class ProjectsController extends Controller
{
    public function index(): ResourceCollection
    {
        $projects = Project::query()
            ->withCount([
                'requirements',
                'requirements as blocked_requirements_count' => fn ($query) => $query->whereNotNull('blocked_reason'),
                'unknowns',
                'tasks',
                'requirements as requirements_with_tasks_count' => fn ($query) => $query->whereHas('tasks'),
                'requirements as requirements_all_tasks_complete_count' => fn ($query) => $query
                    ->whereHas('tasks')
                    ->whereDoesntHave('tasks', fn ($query) => $query->where('is_complete', false)),
            ])
            ->orderBy('name', 'asc')
            ->get();

        return ProjectResource::collection($projects);
    }

    public function store(StoreProjectRequest $request): ProjectResource
    {
        $validated = $request->validated();

        $project = Project::create($validated);

        if (array_key_exists('users', $validated)) {
            $users = array_map(fn ($item) => ['name' => $item], $validated['users']);

            $project->users()->createMany($users);
        }

        if (array_key_exists('features', $validated)) {
            $features = array_map(fn ($item) => ['name' => $item], $validated['features']);

            $project->features()->createMany($features);
        }

        return new ProjectResource($project);
    }

    public function show(Request $request, Project $project): ProjectResource
    {
        if ($request->has('hydrated') && $request->input('hydrated', true)) {
            $project->loadAll();
        }

        return new ProjectResource($project);
    }

    public function update(UpdateProjectRequest $request, Project $project): ProjectResource
    {
        $validated = $request->validated();

        $project->update($validated);

        return new ProjectResource($project);
    }

    public function organise(OrganiseProjectRequest $request, Project $project): JsonResource
    {
        $project->load(['users', 'features', 'requirements']);

        $validated = $request->validated();

        $output = DB::transaction(function () use ($project, $validated) {
            foreach ($validated['users'] as $user) {
                $project->users->find($user['id'])->update($user);
            }

            foreach ($validated['features'] as $feature) {
                $project->features->find($feature['id'])->update($feature);
            }

            foreach ($validated['requirements'] as $requirement) {
                if ($project->features->contains($requirement['feature_id'])) {
                    $project->requirements->find($requirement['id'])->update($requirement);
                }
            }

            return [
                'users' => $project->users->map->only(['id', 'weight'])->toArray(),
                'features' => $project->features->map->only(['id', 'weight'])->toArray(),
                'requirements' => $project->requirements->map->only(['id', 'feature_id', 'weight'])->toArray(),
            ];
        });

        return new JsonResource($output);
    }

    public function destroy(Project $project): Response
    {
        $project->delete();

        return response()->noContent();
    }
}
