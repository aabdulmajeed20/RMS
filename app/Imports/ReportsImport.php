<?php

namespace App\Imports;

use App\Group;
use App\Report;
use App\Tag;
use Exception;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ReportsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        try{
            $name = $row['name'];
            $content = $row['content'];
            $group = Group::firstOrCreate([
                'name' => $row['group']
            ]);
            $tags = Tag::CreateTagsFromList(explode(',', $row['tags']));
    
            $report = Report::create([
                'name' => $row['name'],
                'content' => $content,
                'user_id' => Auth::user()->id,
                'group_id' => $group->id,
            ]);
            $report->assignTags($tags);
            
            return $report;
        } catch(Exception $e) {
            return "<h1>There is an error in file format</h1>";
        }
    }
}
