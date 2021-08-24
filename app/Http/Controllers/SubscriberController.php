<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Lists;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubscriberController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request)
    {
        $user = auth()->user() ?? User::whereUid($request->headers->get('X-API-Key'))->first();
        $this->validate($request, [
            'email' => [Rule::requiredIf($request->phone == null), 'email'],
            'phone' => [Rule::requiredIf($request->email == null), 'phone:CM,AUTO'],
            'list_id' => ['required', Rule::exists('lists', 'uid')->where('user_id', $user->id)]
        ]);

        $list = Lists::where('uid', $request->list_id)->whereUserId($user->id)->first();

        if (!$list) {
            return response('List Not Found', 404);
        }

        if ($request->phone) {
            $contact = $user->contacts()->firstOrCreate([
                'phone' => $request->email
            ], $request->only("first_name", "last_name", "email", "gender", "birthday", "website", "zip_code"));
        } else {
            $contact = $user->contacts()->firstOrCreate([
                'email' => $request->email
            ], $request->only("first_name", "last_name", "phone", "gender", "birthday", "website", "zip_code"));
        }

        $list->subscriptions()->create([
            'contact_id' => $contact->id,
            'status' => 'enabled'
        ]);

        return response()->json([], 201);
    }

    /**
     * Update a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subscribeOrUpdate(Request $request)
    {
        $user = auth()->user() ?? User::whereUid($request->headers->get('X-API-Key'))->first();
        $this->validate($request, [
            'email' => [Rule::requiredIf($request->phone == null), 'email'],
            'phone' => [Rule::requiredIf($request->email == null), 'phone:CM,AUTO'],
            'list_id' => ['required', Rule::exists('lists', 'uid')->where('user_id', $user->id)]
        ]);

        $list = Lists::where('uid', $request->list_id)->whereUserId($user->id)->first();

        if (!$list) {
            return response('List Not Found', 404);
        }

        if ($request->phone) {
            $contact = $user->contacts()->firstOrCreate([
                'phone' => $request->email
            ], $request->only("first_name", "last_name", "email", "gender", "birthday", "website", "zip_code"));
        } else {
            $contact = $user->contacts()->firstOrCreate([
                'email' => $request->email
            ], $request->only("first_name", "last_name", "phone", "gender", "birthday", "website", "zip_code"));
        }



        $list->subscriptions()->firstOrCreate([
            'contact_id' => $contact->id,
        ]);
        return response()->json();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unsubscribe(Request $request)
    {
        $user = auth()->user() ?? User::whereUid($request->headers->get('X-API-Key'))->first();

        $this->validate($request, [
            'email' => [Rule::requiredIf($request->phone == null), 'email'],
            'phone' => [Rule::requiredIf($request->email == null), 'phone:CM,AUTO'],
            'list_id' => ['required', Rule::exists('lists', 'uid')->where('user_id', $user->id)]
        ]);

        $list = Lists::where('uid', $request->list_id)->whereUserId($user->id)->first();

        if (!$list) {
            return response('List Not Found', 404);
        }


        $list = Lists::where('uid', $request->list_id)->first();

        if ($request->email) {
            $contact = Contact::whereUserId($user->id)->where(function ($query) use ($request) {
                return $query->where('email', $request->email);
            })->first();
        } else {
            $contact = Contact::whereUserId($user->id)->where(function ($query) use ($request) {
                return $query->where('phone', $request->phone);
            })->first();
        }

        $list->subscriptions()->whereContactId($contact->id)->delete();
        return response()->json();
    }
}
