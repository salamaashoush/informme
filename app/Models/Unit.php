<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable=['name','area','div_id','population','description'];
    public function division()
    {
        return $this->belongsTo('App\Division','div_id');
    }
    public function villages()
    {
        return $this->hasMany('App\Village','div_id');
    }
    public function hamlets()
    {
        return $this->hasMany('App\Hamlet','div_id');
    }
    public function photos()
    {
        return $this->morphMany('App\Photo', 'imageable');
    }
    public function articles()
    {
        return $this->morphMany('App\Article', 'articlable');
    }
    public function edit_route()
    {
        return 'units.edit';
    }
}
