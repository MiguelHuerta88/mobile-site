<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

// home route
Route::get(
    '/',
    [
        'as' => 'site.home',
        'uses' => 'HomeController@home'
    ]
);

// our register route. should remain hidden only users that know url can get
Route::get(
        '/admin-register',
        [
            'as' => 'admin.register',
            'uses' => 'RegisterController@register'
        ]
);