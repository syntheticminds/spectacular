<?php

namespace Spectacular\Core\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Support\Str;
use Spectacular\Core\Models\Feature;
use Spectacular\Core\Models\Requirement;
use Spectacular\Core\Models\Task;
use Spectacular\Core\Models\Unknown;

class Project extends Model
{
    use HasFactory;
    use HasRelationships;
    use Traits\Revisionable;

    protected $fillable = [
        'description',
        'name',
    ];

    protected static function booted(): void
    {
        static::creating(function ($project) {
            if (!$project->uuid) {
                $project->uuid = (string) Str::uuid();
            }
        });

        static::deleting(function ($project) {
            $project->features()->withTrashed()->get()->each->forceDelete();
            $project->users()->withTrashed()->get()->each->forceDelete();
        });
    }

    /* Relations */

    public function features(): HasMany
    {
        return $this->hasMany(Feature::class);
    }

    public function requirements(): HasManyThrough
    {
        return $this->hasManyThrough(Requirement::class, Feature::class);
    }

    public function unknowns(): HasManyDeep
    {
        return $this->hasManyDeep(Unknown::class, [Feature::class, Requirement::class]);
    }

    public function tasks(): HasManyDeep
    {
        return $this->hasManyDeep(Task::class, [Feature::class, Requirement::class]);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /* Helpers */

    public function loadAll(): static
    {
        return $this->load([
            'features',
            'features.requirements',
            'features.requirements.assignments.user',
            'features.requirements.unknowns',
            'features.requirements.tasks',
            'users',
        ]);
    }

    public function featuresEstimate(): Attribute
    {
        return new Attribute(fn () => $this->features->sum('requirements_estimate'));
    }

    public function totalEstimate(): Attribute
    {
        return new Attribute(fn () => $this->features_estimate);
    }
}
