<?php

namespace Spectacular\Core\Http\Controllers\Api;

use Spectacular\Core\Http\Controllers\Controller;
use Spectacular\Core\Http\Resources\FeatureResource;
use Spectacular\Core\Http\Requests\StoreFeatureRequest;
use Spectacular\Core\Http\Requests\UpdateFeatureRequest;
use Spectacular\Core\Models\Feature;
use Illuminate\Http\Response;

class FeaturesController extends Controller
{
    public function store(StoreFeatureRequest $request): FeatureResource
    {
        $validated = $request->validated();

        $feature = Feature::create($validated);

        return new FeatureResource($feature);
    }

    public function update(UpdateFeatureRequest $request, Feature $feature): FeatureResource
    {
        $validated = $request->validated();

        $feature->update($validated);

        return new FeatureResource($feature);
    }

    public function destroy(Feature $feature): Response
    {
        $feature->delete();

        return response()->noContent();
    }
}
