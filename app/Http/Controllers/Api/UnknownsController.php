<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UnknownResource;
use App\Http\Requests\StoreUnknownRequest;
use App\Http\Requests\UpdateUnknownRequest;
use App\Models\Unknown;
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

    public function destroy(Unknown $unknown): Response
    {
        $unknown->delete();

        return response()->noContent();
    }
}
