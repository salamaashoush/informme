<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable=['name','area','gover_id','is_division','districts','divisions','units','population','p_density_rate','creation_date','national_day','description'];
    public function division()
    {
        return $this->belongsTo('App\Division','div_id');
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
        return 'cities.edit';
    }
}
