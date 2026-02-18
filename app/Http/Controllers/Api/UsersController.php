<?php

namespace Spectacular\Core\Http\Controllers\Api;

use Spectacular\Core\Http\Controllers\Controller;
use Spectacular\Core\Http\Resources\UserResource;
use Spectacular\Core\Http\Requests\StoreUserRequest;
use Spectacular\Core\Http\Requests\UpdateUserRequest;
use Spectacular\Core\Models\User;
use Illuminate\Http\Response;

class UsersController extends Controller
{
    public function store(StoreUserRequest $request): UserResource
    {
        $validated = $request->validated();

        $user = User::create($validated);

        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, User $user): UserResource
    {
        $validated = $request->validated();

        $user->update($validated);

        return new UserResource($user);
    }

    public function delete(User $user): Response
    {
        $user->delete();

        return response()->noContent();
    }
}
