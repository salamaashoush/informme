<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hamlet extends Model
{
    protected $fillable=['name','area','unit_id','population','description'];
    public function uint()
    {
        return $this->belongsTo('App\Uint','unit_id');
    }
    public function photos()
    {
        return $this->morphMany('App\Photo', 'imageable');
    }
    public function articles()
    {
        return $this->morphMany('App\Article', 'articlable');
    }
}
