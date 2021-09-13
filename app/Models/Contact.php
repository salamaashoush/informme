<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Contact extends Model
{
    protected $fillable = ['phone', 'mobile', 'fax', 'email', 'website'];

    public function contactable(): MorphMany
    {
        return $this->morphMany(Contact::class, 'contactable');
    }


}
