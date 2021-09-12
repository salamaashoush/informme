<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Person extends Model
{
    protected $fillable = ['name', 'job', 'desciption', 'is_historical'];

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
        return $this->morphMany(Photo::class, 'reviewable');
    }

    public function contact(): MorphMany
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    public function personable(): MorphTo
    {
        return $this->morphTo();
    }
}
