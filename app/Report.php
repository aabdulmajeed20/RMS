<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{

    protected $fillable = [
        'name', 'content', 'user_id'
    ];

    public function tags()
    {
        $this->belongsToMany('App\Tag');
    }
    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function assignGroup($group)
    {
        $this->groups()->syncWithoutDetaching($group);
    }
}
