<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable=['name','desc','cat_id','parent_id','lft','rgt','depth'];
    public function photos()
    {
        return $this->morphMany('App\Photo', 'imageable');
    }
    public function reviews()
    {
        return $this->morphMany('App\Review', 'reviewable');
    }
    public function center()
    {
        return $this->belongsTo('App\Center','center_id');
    }
    public function articles()
    {
        return $this->morphMany('App\Article', 'articlable');
    }
    public function centers()
    {
        return $this->belongsToMany('App\Center','center_service');
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
