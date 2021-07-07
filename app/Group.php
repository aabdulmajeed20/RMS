<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function reports()
    {
        $this->belongsToMany('App\Report');
    }

    public function users()
    {
        $this->belongsToMany('App\User');
    }
}
