<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Village extends Model
{
    protected $fillable = ['name', 'area', 'div_id', 'population', 'description'];

    public function uint(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'div_id');
    }

    public function hamlets(): BelongsTo
    {
        return $this->belongsTo(Hamlet::class, 'unit_id');
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
