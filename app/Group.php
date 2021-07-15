<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    protected $fillable = [
        'name',
    ];

    public function reports()
    {
        return $this->hasMany('App\Report');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function checkUserAssigned($user)
    {
        $users = $this->users()->get();
        if($users->contains($user)) return true;
        
        return false;
    }

    public function assignUsers($users)
    {
        $this->users()->sync($users);
    }

    public function hasUser($user)
    {
        return $this->users->contains($user);
    }
}
