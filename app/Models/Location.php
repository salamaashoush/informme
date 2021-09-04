<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable=['name','area','div_id','unit_id','long','lat','code','time_zone','adress_1','adress_2'];
    public function unit()
    {
        return $this->belongsTo('App\Unit','unit_id');
    }
    public function division()
    {
        return $this->belongsTo('App\Division','div_id');
    }
    public function centers()
    {
        return $this->morphedByMany('App\Center', 'locationable');
    }
    public function places()
    {
        return $this->morphedByMany('App\Place', 'locationable');
    }
    public function articles()
    {
        return $this->morphMany('App\Article', 'articlable');
    }
}
