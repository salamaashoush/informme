<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Place extends Model
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

    public function category(): BelongsTo
    {
        return $this->belongsTo('App\Category', 'cat_id');
    }

    public function meta(): MorphMany
    {
        return $this->morphMany('App\Meta', 'metable');
    }
}
