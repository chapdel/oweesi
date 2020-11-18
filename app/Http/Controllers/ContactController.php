<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Lists;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContactController extends Controller
{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'uid' => ['required', Rule::exists('lists')->where('user_id', auth()->id())]
        ]);

        $list = Lists::where('uid', $request->uid)->first();
        $list->contacts()->Create([
            'email' => $request->email,
            'status' => 'enabled'
        ]);

        /* if ($request->ajax()) {
            return response()->json([
                'status' => 'success'
            ]);
        } */

        return response()->json();
    }

    /**
     * Update a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subscribeOrUpdate(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'uid' => ['required', Rule::exists('lists')->where('user_id', auth()->id())]
        ]);

        $list = Lists::where('uid', $request->uid)->first();
        $list->contacts()->CreateOrUpdate([
            'email' => $request->email,
            'status' => 'enabled'
        ]);
        return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $list = Lists::where('email', $id)->firstOrFail();

        return response()->json($list);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unsubscribe(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'uid' => ['required', Rule::exists('lists')->where('user_id', auth()->id())]
        ]);

        $list = Lists::where('uid', $request->uid)->first();
        $contact = Contact::where('email', $request->email)->where('list_id', $list->id)->firstOrFail();
        $contact->status = 'disabled';
        $contact->save();

        return response()->json();
    }
}
