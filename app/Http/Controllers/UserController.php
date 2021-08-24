<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Lawyer\Rules\StrongPassword;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $user = $request->user();

        $this->validate($request, [
            "name" => ['required', 'string', 'min:3'],
            'email' => ["required", 'email', 'unique:users,email,' . $user->id],
            'currency' => ['nullable', 'exists:_currencies_,code'],
        ]);
        if ($request->email) {
            $user->email = $request->email;
        }

        if ($request->name) {
            $user->name = $request->name;
        }

        $user->save();

        return response()->json(new UserResource($user->refresh()));
    }

    /**
     * Update the user's password.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function password(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|password',
            'password' => ['required', 'confirmed', new StrongPassword()],
        ]);

        $request->user()->update([
            'password' => app('hash')->make($request->password),
        ]);

        return response()->json($request->user()->update([
            'password' => app('hash')->make($request->password)
        ]));
    }
}
