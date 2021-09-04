<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Center extends \Baum\Node
{
    protected $fillable=['name','desc','cat_id'];

    public function location()
    {
        return $this->morphToMany('App\Location', 'locationable');
    }
    public function articles()
    {
        return $this->morphMany('App\Article', 'articlable');
    }
    public function photos()
    {
        return $this->morphMany('App\Photo', 'imageable');
    }
    public function reviews()
    {
        return $this->morphMany('App\Review', 'reviewable');
    }
    public function contact()
    {
        return $this->morphMany('App\Contact', 'imageable');
    }
    public function services()
    {
        return $this->belongsToMany('App\Service','center_service');
    }
    public function category()
    {
        return $this->belongsTo('App\Category', 'cat_id');
    }
    public function meta()
    {
        return $this->morphMany('App\Meta', 'metable');
    }
}
