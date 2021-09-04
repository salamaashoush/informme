<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable=['body','rate','user_id'];
    public function reviewable()
    {
        return $this->morphTo();
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
