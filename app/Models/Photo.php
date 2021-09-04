<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable=['name','thumb','url','tag'];
    public function imageable()
    {
        return $this->morphTo();
    }
    public function scopeLogos($query)
    {
        $query->where('tag','=','logos');
    }
    public function scopeFlags($query)
    {
        $query->where('tag','=','flags');
    }
    public function scopeFeatures($query)
    {
        $query->where('tag','=','features');
    }
}
