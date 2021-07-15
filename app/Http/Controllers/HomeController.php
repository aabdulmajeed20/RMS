<?php

namespace App\Http\Controllers;

use App\Group;
use App\Report;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $groups = Group::all();
        $tags = Tag::all();
        return view('home', compact('groups', 'tags'));
    }
    public function settings()
    {
        return view('settings.index');
    }

    public function reportsJSON(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'report_name',
            2 => 'report_uploader',
            3 => 'report_group',
            4 => 'tags',
            5 => 'creation_date',
        );
        $user = User::find(Auth::user()->id);

        $totalData = sizeof($user->getGroupReports());
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
    
        $reports =  DB::table('reports')
                        ->select('reports.id', 'reports.name as report_name', 'users.name as report_uploader', 'groups.name as report_group', 'reports.created_at as creation_date')
                        ->distinct()
                        ->join('groups', 'groups.id', '=', 'reports.group_id')
                        ->join('users', 'users.id', '=', 'reports.user_id')
                        ->leftJoin('report_tag', 'report_tag.report_id', '=', 'reports.id')
                        ->leftJoin('tags', 'tags.id', '=', 'report_tag.tag_id')
                        ->where('reports.deleted_at', null);
        if($user->role_id == 2) {
            $reports->whereIn('reports.group_id', $user->getGroupsIds());
        }

        if( !empty($request['columns'][3]['search']['value']) && $request['columns'][3]['search']['value'] != "Group" ) {
            $reports = $reports->where('groups.name', '=',"{$request['columns'][3]['search']['value']}");
        }
        if( !empty($request['columns'][4]['search']['value']) && $request['columns'][4]['search']['value'] != "Tags" ) {
            $reports = $reports->where('tags.name', '=',"{$request['columns'][4]['search']['value']}");
        }

        if(!empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $reports = $reports->where(function($query) use($search) {
                $query->where('reports.id','LIKE',"%{$search}%")
                        ->orWhere('reports.name', 'LIKE',"%{$search}%")
                        ->orWhere('users.name', 'LIKE',"%{$search}%");
            });
        }

        $totalFiltered = $reports->count();
        DB::enableQueryLog();
        $reports = $reports->offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get();
        
        $data = array();
        if(!empty($reports))
        {
            foreach ($reports as $report)
            {
                $year = explode(" ", $report->creation_date)[0];
                $show =  route('report.show',['id' => $report->id]);

                $nestedData['id'] = $report->id;
                $nestedData['report_name'] = "<a href=\"{$show}\">$report->report_name</a>";
                // $nestedData['report_name'] = $report->report_name;
                $nestedData['report_uploader'] = $report->report_uploader;
                $nestedData['report_group'] = $report->report_group;
                $nestedData['tags'] = Report::find($report->id)->getTagsName();
                $nestedData['creation_date'] = $year;
                $data[] = $nestedData;
            }
            $json_data = array(
                "draw"            => intval($request->input('draw')),  
                "recordsTotal"    => intval($totalData),  
                "recordsFiltered" => intval($totalFiltered),
                "query"           => DB::getQueryLog(),
                "data"            => $data
            );
            return json_encode($json_data);
        }
    }
}
