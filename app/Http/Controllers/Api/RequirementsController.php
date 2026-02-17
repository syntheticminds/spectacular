<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RequirementResource;
use App\Http\Requests\StoreRequirementRequest;
use App\Http\Requests\UpdateRequirementRequest;
use App\Models\Requirement;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\JsonResource;

class RequirementsController extends Controller
{
    public function show(Requirement $requirement): RequirementResource
    {
        return new RequirementResource($requirement);
    }

    public function store(StoreRequirementRequest $request): RequirementResource
    {
        // TODO: Make sure the user_id is within the same project as the feature_id

        $validated = $request->validated();

        $requirement = Requirement::create($validated);
        $requirement->assignments()->createMany(array_map(fn ($user_id) => ['user_id' => $user_id], $validated['user_ids']));
        $requirement->unknowns()->createMany($validated['unknowns']);
        $requirement->tasks()->createMany($validated['tasks']);

        // We have to fetch a new copy because the reference is set after create.
        return new RequirementResource($requirement->fresh(['assignments', 'unknowns', 'tasks']));
    }

    public function update(UpdateRequirementRequest $request, Requirement $requirement): RequirementResource
    {
        // TODO: Make sure the user_id is within the same project as the feature_id

        $validated = $request->validated();

        $requirement->update($validated);

        if (array_key_exists('user_ids', $validated)) {
            $requirement->assignments->whereNotIn('user_id', $validated['user_ids'])->each->delete();

            foreach ($validated['user_ids'] as $user_id) {
                $requirement->assignments()->updateOrCreate(['user_id' => $user_id]);
            }

            $requirement->load('assignments');
        }

        if (array_key_exists('unknowns', $validated)) {
            $remaining_keys = array_column($validated['unknowns'], 'id');

            $requirement->unknowns->except($remaining_keys)->each->delete();

            foreach ($validated['unknowns'] as $unkown) {
                $requirement->unknowns()->updateOrCreate(
                    ['id' => $unkown['id'] ?? null],
                    $unkown,
                );
            }

            $requirement->load('unknowns');
        }

        if (array_key_exists('tasks', $validated)) {
            $remaining_keys = array_column($validated['tasks'], 'id');

            if ($remaining_keys) {
                $requirement->tasks->except($remaining_keys)->each->delete();
            }

            foreach ($validated['tasks'] as $task) {
                $requirement->tasks()->updateOrCreate(
                    ['id' => $task['id'] ?? null],
                    $task,
                );
            }

            $requirement->load('tasks');
        }

        return new RequirementResource($requirement);
    }

    public function destroy(Requirement $requirement): Response
    {
        $requirement->delete();

        return response()->noContent();
    }

    public function completeTasks(Requirement $requirement): JsonResource
    {
        $result = $requirement->tasks
            ->each->complete()
            ->map->only('id', 'is_complete');

        return new JsonResource($result);
    }
}
