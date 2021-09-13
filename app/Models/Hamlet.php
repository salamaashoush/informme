<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Hamlet extends Model
{
    protected $fillable = ['name', 'area', 'unit_id', 'population', 'description'];

    public function uint(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function photos(): MorphMany
    {
        return $this->morphMany(Photo::class, 'imageable');
    }

    public function articles(): MorphMany
    {
        return $this->morphMany(Article::class, 'articlable');
    }
}
