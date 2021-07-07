<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function abilities()
    {
        $this->belongsToMany('App\Ability');
    }
    public function users()
    {
        $this->belongsToMany('App\User');
    }
}
