<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::all();
        return view('settings.groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('settings.groups.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $group = Group::create([
                'name' => $request['group_name'],
            ]);
            $group->assignUsers($request['users']);
        } catch (QueryException $e) {
            return back()->with(['error_message' => 'Please fill all fields']);
        } catch(Exception $e) {
            return back()->with(['error_message' => $e->getMessage()]);
        }
        return redirect()->route('settings.groups.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = Group::find($id);
        $users = User::all();
        return view('settings.groups.edit', compact('group', 'users'));
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
        try {
            $group = Group::find($id);
            $group->name = $request['group_name'];
            $group->update();
            $group->assignUsers($request['users']);
        } catch (QueryException $e) {
            return back()->with(['error_message' => 'Please fill all fields']);
        } catch(Exception $e) {
            return back()->with(['error_message' => $e->getMessage()]);
        }
        return redirect()->route('settings.groups.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Group::find($id);
        $group->delete();
        return redirect()->route('settings.groups.index');
    }
}
