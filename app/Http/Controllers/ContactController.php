<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Lists;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContactController extends Controller
{

    public function index(Request $request)
    {
        $user = auth()->user() ?? User::whereUid($request->headers->get('X-API-Key'))->first();

        return response()->json($user->contacts()->get());
    }

    public function store(Request $request)
    {
        $user = auth()->user() ?? User::whereUid($request->headers->get('X-API-Key'))->first();

        $this->validate($request, [
            'email' => [Rule::requiredIf($request->phone == null), 'email'],
            'phone' => [Rule::requiredIf($request->email == null), 'phone:CM,AUTO'],
        ]);

        $contact = $user->contacts()->create([
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        if ($request->data) {

            foreach ($request->data as $key => $value) {
                if (array_key_exists($key, $contact->attributesToArray())) {
                    $contact->name = $value;
                }
            }

            $contact->save();
        }
        return response()->json($contact->refresh());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $uid)
    {
        $user = auth()->user() ?? User::whereUid($request->headers->get('X-API-Key'))->first();
        $contact = Contact::whereUserId($user->id)->where(function ($query) use ($uid) {
            return $query->where('email', $uid)->orWhere('uid', $uid)->orWhere('phone', $uid);
        })->first();

        if (!$contact) {
            return response('Contact Not Found', 404);
        }
        return response()->json($contact);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $uid)
    {
        $user = auth()->user() ?? User::whereUid($request->headers->get('X-API-Key'))->first();
        $contact = Contact::whereUserId($user->id)->where(function ($query) use ($uid) {
            return $query->where('email', $uid)->orWhere('uid', $uid)->orWhere('phone', $uid);
        })->first();

        if (!$contact) {
            return response('Contact Not Found', 404);
        }

        $contact->delete();
        return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uid)
    {
        $user = auth()->user() ?? User::whereUid($request->headers->get('X-API-Key'))->first();

        $this->validate($request, [
            'email' => [Rule::requiredIf($request->phone == null), 'email'],
            'phone' => [Rule::requiredIf($request->email == null), 'phone:CM,AUTO'],
        ]);
        $contact = Contact::whereUserId($user->id)->where(function ($query) use ($uid) {
            return $query->where('email', $uid)->orWhere('uid', $uid)->orWhere('phone', $uid);
        })->first();



        if (!$contact) {
            return response('Contact Not Found', 404);
        }

        $contact->update($request->all());
        return response()->json($contact->refresh());
    }
}
