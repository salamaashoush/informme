<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Location extends Model
{
    protected $fillable = ['name', 'area', 'div_id', 'unit_id', 'long', 'lat', 'code', 'time_zone', 'adress_1', 'adress_2'];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'div_id');
    }

    public function centers(): MorphToMany
    {
        return $this->morphedByMany(Center::class, 'locationable');
    }

    public function places(): MorphToMany
    {
        return $this->morphedByMany(Place::class, 'locationable');
    }

    public function articles(): MorphMany
    {
        return $this->morphMany(Article::class, 'articlable');
    }
}
