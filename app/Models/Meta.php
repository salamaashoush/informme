<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $fillable=['key','value'];
    public function metable()
    {
        return $this->morphTo();
    }
}
