<?php

namespace Spectacular\Core\Http\Controllers\Api;

use Spectacular\Core\Http\Controllers\Controller;
use Spectacular\Core\Http\Resources\TaskResource;
use Spectacular\Core\Http\Requests\StoreTaskRequest;
use Spectacular\Core\Http\Requests\UpdateTaskRequest;
use Spectacular\Core\Models\Task;
use Illuminate\Http\Response;

class TasksController extends Controller
{
    public function store(StoreTaskRequest $request): TaskResource
    {
        $validated = $request->validated();

        $task = Task::create($validated);

        return new TaskResource($task);
    }

    public function update(UpdateTaskRequest $request, Task $task): TaskResource
    {
        $validated = $request->validated();

        $task->update($validated);

        return new TaskResource($task);
    }

    public function delete(Task $task): Response
    {
        $task->delete();

        return response()->noContent();
    }
}
