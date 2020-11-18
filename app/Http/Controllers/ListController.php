<?php

namespace App\Http\Controllers;

use App\Models\Lists;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('List/Index', ['lists' => Lists::where('user_id', auth()->id())->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
        ]);

        $list =   Lists::create([
            'title' => $request->title,
            'description' => $request->description,
            'uid' => Lists::uid(),
            'user_id' => auth()->id()
        ]);

        if ($request->ajax()) {
            return response()->json($list);
        }

        //todo : Add flash message
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($list)
    {
        $list = Lists::where('uid', $list)->firstOrFail();

        return Inertia::render('List/Show', ['contacts' => $list->contacts()->orderBy('created_at', 'DESC')->get(), 'list' => $list]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
