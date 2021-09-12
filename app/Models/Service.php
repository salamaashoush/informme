<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Service extends Model
{
    protected $fillable = ['name', 'desc', 'cat_id', 'parent_id', 'lft', 'rgt', 'depth'];

    public function photos(): MorphMany
    {
        return $this->morphMany(Photo::class, 'imageable');
    }

    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class, 'center_id');
    }

    public function articles(): MorphMany
    {
        return $this->morphMany(Article::class, 'articlable');
    }

    public function centers(): BelongsToMany
    {
        return $this->belongsToMany(Center::class, 'center_service');
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
