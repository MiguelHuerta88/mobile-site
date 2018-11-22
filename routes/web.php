<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// home route
Route::get(
    '/',
    [
        'as' => 'site.home',
        'uses' => 'HomeController@home'
    ]
);

// THIS ROUTE NO LONGER NEEDED. WE ARE MOVING TO A SINGLE PAGE DESIGN
/*Route::get(
    '/{type}',
    [
        'as' => 'site.page',
        'uses' => 'PageController@view'
    ]
)->where('type', '(about|project|download)');*/

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