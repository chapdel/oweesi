<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //Add this method to the Controller class
    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'user' => new UserResource(auth()->user()),
            'expires_in' => Auth::factory()->getTTL()
        ], 200);
    }
}
