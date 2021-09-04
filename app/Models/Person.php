<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable=['name','job','desciption','is_historical'];

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
        return $this->morphMany('App\Photo', 'reviewable');
    }
    public function contact()
    {
        return $this->morphMany('App\Contact', 'contactable');
    }
    public function personable()
    {
        return $this->morphTo();
    }
}
