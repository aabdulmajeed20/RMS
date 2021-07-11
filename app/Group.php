<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
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

    public function assignUser($user)
    {
        $this->users()->syncWithoutDetaching($user->id);
    }
}
