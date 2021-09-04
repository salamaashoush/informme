<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable=['type','title','body'];
    public function articlable()
    {
        return $this->morphTo();
    }
    public function photos()
    {
        return $this->morphMany('App\Photo', 'imageable');
    }
    public function reviews()
    {
        return $this->morphMany('App\Review', 'reviewable');
    }

}
