<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
    ];
    public function reports()
    {
        return $this->belongsToMany('App\Report');
    }

    public static function CreateTagsFromList($tags)
    {
        $result = [];
        foreach($tags as $tagName) {
            $tag = Tag::firstOrCreate([
                'name' => $tagName
            ]);
            array_push($result, $tag);
        }
        return $result;
    }
}
