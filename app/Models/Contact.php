<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable=['phone','mobile','fax','email','website'];
    public function contactable()
    {
        return $this->morphMany('App\Contact', 'contactable');
    }


}
