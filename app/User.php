<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function groups()
    {
        return $this->belongsToMany('App\Group');
    }

    public function assignGroup($group)
    {
        return $this->groups()->syncWithoutDetaching($group);
    }

    public function getGroupReports()
    {
        return $this->groups->map->reports;
    }

    public function reports()
    {
        return $this->hasMany('App\Report');
    }

    public function getGroupsIds()
    {
        return $this->groups->map(function($group) {
            return $group->id;
        });
    }    
}
