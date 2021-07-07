<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public function tags()
    {
        $this->belongsToMany('App\Tag');
    }
    public function groups()
    {
        $this->belongsToMany('App\Group');
    }
}
