<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user() ?? User::whereUid($request->headers->get('X-API-Key'))->first();

        return response()->json($user->lists);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required'],
        ]);

        $user = auth()->user() ?? User::whereUid($request->headers->get('X-API-Key'))->first();

        $list = $user->lists()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json($list, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $list_id)
    {
        $user = auth()->user() ?? User::whereUid($request->headers->get('X-API-Key'))->first();
        $list = $user->lists()->where('uid', $list_id)->with('subscriptions')->first();

        if (!$list) {
            return response('List Not Found', 404);
        }

        return response()->json($list);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $list_id)
    {
        $user = auth()->user() ?? User::whereUid($request->headers->get('X-API-Key'))->first();

        $list = $user->lists()->whereUid($list_id)->first();
        if (!$list) {
            return response('List Not Found', 404);
        }

        $list->update($request->all());

        return response()->json($list->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $list_id)
    {
        $user = auth()->user() ?? User::whereUid($request->headers->get('X-API-Key'))->first();

        $list = $user->lists()->whereUid($list_id)->first();

        if (!$list) {
            return response('List Not Found', 404);
        }

        $list->delete();

        return response()->json();
    }
}
