<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

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
        return $this->morphMany('App\Review', 'reviewable');
    }
    public function contact()
    {
        return $this->morphMany('App\Contact', 'contactable');
    }
    public function meta()
    {
        return $this->morphMany('App\Meta', 'metable');
    }
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role')->withTimestamps();
    }

    public function hasRole($name)
    {
        foreach($this->roles as $role)
        {
            if($role->name == $name) return true;
        }

        return false;
    }

    public function assignRole($role)
    {
        return $this->roles()->attach($role);
    }

    public function removeRole($role)
    {
        return $this->roles()->detach($role);
    }
}
