<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Category extends \Baum\Node
{
    protected $fillable=['name','type'];
    public function centers()
    {
        return $this->hasMany('App\Center', 'cat_id');
    }
    public function services()
    {
        return $this->hasMany('App\Service', 'cat_id');
    }
    public function places()
    {
        return $this->hasMany('App\Place', 'cat_id');
    }

}
