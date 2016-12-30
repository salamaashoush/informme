<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    protected $fillable=['name','area','type','capital','population','p_density_rate','code','time_zone','website','description'];


    public function divisions()
    {
        return $this->hasMany('App\Division','gover_id');
    }
    public function cities()
    {
        return $this->hasMany('App\City','gover_id');
    }
    public function units()
    {
        return $this->hasManyThrough('App\Unit','App\Division','gover_id','div_id');
    }
    public function villages()
    {
        return $this->hasManyThrough('App\Village','App\Division','gover_id','div_id');
    }
    public function hamlets()
    {
        return $this->hasManyThrough('App\Hamlet','App\Division','gover_id','div_id');
    }
    public function photos()
    {
        return $this->morphMany('App\Photo', 'imageable');
    }
    public function articles()
    {
        return $this->morphMany('App\Article', 'articlable');
    }
    public function locations()
    {
        return $this->morphToMany('App\Location', 'locationable');
    }

    public $edit_route="governorates.edit";

}
