<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $fillable=['name','area','div_id','population','description'];
    public function uint()
    {
        return $this->belongsTo('App\Uint','unit_id');
    }
    public function division()
    {
        return $this->belongsTo('App\Division','div_id');
    }
    public function hamlets()
    {
        return $this->belongsTo('App\Hamlet','unit_id');
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
