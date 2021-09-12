<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

// TODO: figure out if we need nested set model https://github.com/lazychaser/laravel-nestedset#installation
class Category extends Model
{
    protected $fillable = ['name', 'type'];

    public function centers(): HasMany
    {
        return $this->hasMany(Center::class, 'cat_id');
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class, 'cat_id');
    }

    public function places(): HasMany
    {
        return $this->hasMany(Place::class, 'cat_id');
    }

}
