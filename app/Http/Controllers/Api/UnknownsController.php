<?php

namespace Spectacular\Core\Http\Controllers\Api;

use Spectacular\Core\Http\Controllers\Controller;
use Spectacular\Core\Http\Resources\UnknownResource;
use Spectacular\Core\Http\Requests\StoreUnknownRequest;
use Spectacular\Core\Http\Requests\UpdateUnknownRequest;
use Spectacular\Core\Models\Unknown;
use Illuminate\Http\Response;

class UnknownsController extends Controller
{
    public function store(StoreUnknownRequest $request): UnknownResource
    {
        $validated = $request->validated();

        $unknown = Unknown::create($validated);

        return new UnknownResource($unknown);
    }

    public function update(UpdateUnknownRequest $request, Unknown $unknown): UnknownResource
    {
        $validated = $request->validated();

        $unknown->update($validated);

        return new UnknownResource($unknown);
    }

    public function delete(Unknown $unknown): Response
    {
        $unknown->delete();

        return response()->noContent();
    }
}
