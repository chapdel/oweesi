<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Resources\UserResource;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return response()->json(['message' => "Welcome on " . config('app.name')]);
});

// guest user
$router->group([], function () use ($router) {
    $router->post('/register', "AuthController@register");
    // Matches "/login
    $router->post('/login', 'AuthController@login');
});


// authenticated user
$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/user', function () {
        return response()->json(new UserResource(auth()->user()));
    });

    $router->post('/user', "UserController@update");
    $router->post('/user/password', "UserController@password");
    $router->post('/logout', function () {
        auth()->logout();
        return response()->json();
    });
});

$router->group(['middleware' => ['auth'], 'prefix' => "c"], function () use ($router) {
    $router->get('lists', 'ListController@index');
    $router->post('lists', 'ListController@store');
    $router->get('lists/{list_id}', 'ListController@show');
    $router->put('lists/{list_id}', 'ListController@update');
    $router->delete('lists/{list_id}', 'ListController@destroy');

    $router->get('contacts', 'ContactController@index');
    $router->post('contacts', 'ContactController@store');
    $router->get('contacts/{uid}', 'ContactController@show');
    $router->delete('contacts/{uid}', 'ContactController@destroy');
});

$router->group(['middleware' => ['auth-api']], function () use ($router) {
    $router->get('lists', 'ListController@index');
    $router->post('lists', 'ListController@store');
    $router->get('lists/{list_id}', 'ListController@show');
    $router->put('lists/{list_id}', 'ListController@update');
    $router->delete('lists/{list_id}', 'ListController@destroy');

    $router->get('contacts', 'ContactController@index');
    $router->post('contacts', 'ContactController@store');
    $router->get('contacts/{uid}', 'ContactController@show');
    $router->delete('contacts/{uid}', 'ContactController@destroy');

    $router->post('subscribe', 'SubscriberController@subscribe');
    $router->post('subscribe-update', 'SubscriberController@subscribeOrUpdate');
    $router->post('unsubscribe', 'SubscriberController@unsubscribe');
});
