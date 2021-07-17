<?php

namespace App\Http\Controllers;

use App\File;
use App\Group;
use App\Imports\ReportsImport;
use App\Report;
use App\Tag;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Console\Input\Input;

class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $groups = $user->groups()->get();
        $tags = Tag::all();
        return view('reports.create', compact('groups', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $report = Report::create([
            'name' => $request['report_name'],
            'content' => $request['content'],
            'user_id' => Auth::user()->id,
            'group_id' => $request['group_id']
        ]);
        $report->assignTags($request['tags']);
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = Report::find($id);
        Gate::authorize('view', $report);
        return view('reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = Report::find($id);
        Gate::authorize('update', $report);
        $user = Auth::user();
        $groups = $user->groups()->get();
        $tags = Tag::all();
        return view('reports.edit', compact('report', 'groups', 'tags', 'files'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $report = Report::find($id);
        Gate::authorize('update', $report);

        $report->content = $request['content'];
        $report->name = $request['report_name'];
        $report->user_id = Auth::user()->id;
        $report->group_id = $request['group_id'];
        $report->update();
        if($request->hasFile('files')) {
            $report->addFiles($request->file('files'));
        }
        $report->assignTags($request['tags']);
        return redirect()->route('report.show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $report = Report::find($id);
        Gate::authorize('delete', $report);
        $report->delete();
        return redirect()->route('home');
    }
    public function deleteFile($id)
    {
        $file = File::find($id);
        $file->delete();
        return back();
    }

    public function importReports()
    {
        return view('reports.importReports');
    }

    public function importExcel()
    {
        Excel::import(new ReportsImport,request()->file('excel'));
           
        return redirect()->route('home');
    }
}
