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
        'uses' => 'AdminController@index'
    ]
)->middleware('admin');

Route::get(
     'admin/edit/{type}',
     [
         'as' => 'admin.edit',
         'uses' => 'AdminController@edit'
     ]
)->middleware('admin');;

Route::post(
    'admin/edit/submit',
    [
        'as' => 'admin.submit',
        'uses' => 'AdminController@postEdit'
    ]
)->middleware('admin');;

Route::get(
    'admin/login',
    [
        'uses' => 'Auth\LoginController@login',
        'as' => 'login'
    ]
);

Route::post(
    'admin/login',
    [
        'uses' => 'Auth\LoginController@doLogin',
        'as' => 'login'
    ]
);

Route::get(
    'admin/logout',
    [
        'uses' => 'Auth\LoginController@logout',
        'as' => 'logout'
    ]
);