<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $fillable=['name','area','type','capital','gover_id','is_district','units','population','description'];
    public function units()
    {
        return $this->hasMany('App\Unit','div_id');
    }
    public function cities()
    {
        return $this->hasMany('App\City','div_id');
    }
    public function villages()
    {
        return $this->hasMany('App\Village','div_id');
    }
    public function hamlets()
    {
        return $this->hasMany('App\Hamlet','div_id');
    }
    public function governorate()
    {
        return $this->belongsTo('App\Governorate','gover_id');
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
        return 'divisions.edit';
    }
}
