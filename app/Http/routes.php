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

Route::get(
    '/{type}',
    [
        'as' => 'site.page',
        'uses' => 'PageController@view'
    ]
)->where('type', '(about|project|download)');

// our register route. should remain hidden only users that know url can get
Route::get(
    '/admin-register',
    [
        'as' => 'admin.register',
        'uses' => 'RegisterController@register'
    ]
);
Route::post(
    '/admin-register',
    [
        'as' => 'admin.register',
        'uses' => 'RegisterController@doRegister'
    ]
);

Route::get(
    '/admin',
    [
        'as' => 'admin.home',
        'middleware' => 'admin',
        'uses' => 'AdminController@index'
    ]
);

Route::get(
     'admin/edit/{type}',
     [
         'as' => 'admin.edit',
         'middleware' => 'admin',
         'uses' => 'AdminController@edit'
     ]
);

Route::post(
    'admin/edit/submit',
    [
        'as' => 'admin.submit',
        'middleware' => 'admin',
        'uses' => 'AdminController@postEdit'
    ]
);

Route::get(
    'admin/login',
    [
        'uses' => 'Auth\AuthController@login',
        'as' => 'login'
    ]
);

Route::post(
    'admin/login',
    [
        'uses' => 'Auth\AuthController@doLogin',
        'as' => 'login'
    ]
);

Route::get(
    'admin/logout',
    [
        'uses' => 'Auth\AuthController@logout',
        'as' => 'logout'
    ]
);