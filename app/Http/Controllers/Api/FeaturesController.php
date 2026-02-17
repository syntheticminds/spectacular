<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FeatureResource;
use App\Http\Requests\StoreFeatureRequest;
use App\Http\Requests\UpdateFeatureRequest;
use App\Models\Feature;
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
