<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Governorate extends Model
{
    use HasFactory;

    public $edit_route = "governorates.edit";
    protected $fillable = ['name', 'area', 'type', 'capital', 'population', 'code', 'time_zone', 'website', 'description'];


    public function divisions(): HasMany
    {
        return $this->hasMany(Division::class, 'gover_id');
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class, 'gover_id');
    }

    public function units(): HasManyThrough
    {
        return $this->hasManyThrough(Unit::class, Division::class, 'gover_id', 'div_id');
    }

    public function villages(): HasManyThrough
    {
        return $this->hasManyThrough(Village::class, Division::class, 'gover_id', 'div_id');
    }

    public function hamlets(): HasManyThrough
    {
        return $this->hasManyThrough(Hamlet::class, Division::class, 'gover_id', 'div_id');
    }

    public function photos(): MorphMany
    {
        return $this->morphMany(Photo::class, 'imageable');
    }

    public function articles(): MorphMany
    {
        return $this->morphMany(Article::class, 'articlable');
    }

    public function locations(): MorphToMany
    {
        return $this->morphToMany(Location::class, 'locationable');
    }

}
