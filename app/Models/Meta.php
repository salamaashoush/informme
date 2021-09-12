<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Meta extends Model
{
    protected $fillable = ['key', 'value'];

    public function metable(): MorphTo
    {
        return $this->morphTo();
    }
}
