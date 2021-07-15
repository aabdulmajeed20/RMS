<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'content', 'user_id'
    ];

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function files()
    {
        return $this->hasMany('App\File');
    }

    public function assignGroup($group)
    {
        $this->groups()->syncWithoutDetaching($group);
    }

    public function assignTags($tags)
    {
        $this->tags()->sync($tags);
    }

    public function hasTag($tag)
    {
        return $this->tags->contains($tag);
    }

    public function addFiles($files)
    {
        foreach ($files as $file) {
            $this->addFile($file);
        }
    }

    public function addFile($file, $name=null)
    {
        $reportFile = new File();
        $destinationPath = 'Files/'; // upload path
        $extension = $file->getClientOriginalExtension();
        $fileName = round(microtime(true) * 1000).'.'.$extension; // renaming image
        $file->move($destinationPath, $fileName);
        $reportFile->path = $destinationPath.$fileName;
        $reportFile->name = $name == null ? $fileName : $name;
        $reportFile->report_id = $this->id;
        $reportFile->save();
    }

    public function getTagsName()
    {
        return $this->tags->map(function($tag) {
            return $tag->name;
        });
    }
}
