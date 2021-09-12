<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Unit extends Model
{
    protected $fillable = ['name', 'area', 'div_id', 'population', 'description'];

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'div_id');
    }

    public function villages(): HasMany
    {
        return $this->hasMany(Village::class, 'div_id');
    }

    public function hamlets(): HasMany
    {
        return $this->hasMany(Hamlet::class, 'div_id');
    }

    public function photos(): MorphMany
    {
        return $this->morphMany(Photo::class, 'imageable');
    }

    public function articles(): MorphMany
    {
        return $this->morphMany(Article::class, 'articlable');
    }

    public function edit_route(): string
    {
        return 'units.edit';
    }
}
