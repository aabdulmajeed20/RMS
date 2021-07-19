<?php

namespace App\Http\Controllers;

use App\Tag;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return view('settings.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.tags.create');
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
            $tag = Tag::firstOrCreate([
                'name' => $request['tag_name'],
            ]);
        } catch (QueryException $e) {
            return back()->with(['error_message' => 'Please fill all fields']);
        } catch(Exception $e) {
            return back()->with(['error_message' => $e->getMessage()]);
        }
        return redirect()->route('settings.tags.index');
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
        $tag = Tag::find($id);
        return view('settings.tags.edit', compact('tag'));
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
            $tag = Tag::find($id);
            $tag->name = $request['tag_name'];
            $tag->update();
        } catch (QueryException $e) {
            return back()->with(['error_message' => 'Please fill all fields']);
        } catch(Exception $e) {
            return back()->with(['error_message' => $e->getMessage()]);
        }
        return redirect()->route('settings.tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete();
        return redirect()->route('settings.tags.index');
    }
}
