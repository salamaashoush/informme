<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

// TODO: figure out if we need nested set model https://github.com/lazychaser/laravel-nestedset#installation

class Center extends Model
{
    protected $fillable = ['name', 'desc', 'cat_id'];

    public function location(): MorphToMany
    {
        return $this->morphToMany(Location::class, 'locationable');
    }

    public function articles(): MorphMany
    {
        return $this->morphMany(Article::class, 'articlable');
    }

    public function photos(): MorphMany
    {
        return $this->morphMany(Photo::class, 'imageable');
    }

    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function contact(): MorphMany
    {
        return $this->morphMany(Contact::class, 'imageable');
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'center_service');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function meta(): MorphMany
    {
        return $this->morphMany(Meta::class, 'metable');
    }
}
