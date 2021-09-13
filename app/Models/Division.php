<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;


class Division extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'area', 'type', 'capital', 'gover_id', 'is_district', 'units', 'population', 'description'];

    public function units(): HasMany
    {
        return $this->hasMany(Unit::class, 'div_id');
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class, 'div_id');
    }

    public function villages(): HasMany
    {
        return $this->hasMany(Village::class, 'div_id');
    }

    public function hamlets(): HasMany
    {
        return $this->hasMany(Hamlet::class, 'div_id');
    }

    public function governorate(): BelongsTo
    {
        return $this->belongsTo(Governorate::class, 'gover_id');
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
        return 'divisions.edit';
    }
}
