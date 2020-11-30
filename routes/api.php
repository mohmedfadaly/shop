<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['middleware' => ['auth:api'], 'namespace' => 'Api'], function (){


///*user*/
 Route::get('home', 'user\userController@home');
 Route::get('section/{id}', 'user\userController@section');
 Route::get('top/{id}', 'user\userController@top');
 Route::get('near/{id}', 'user\userController@near');
 Route::get('provider/{id}', 'user\userController@provider');
 Route::get('provider/{id}/reqcreate', 'user\userController@reqcreate');
 Route::post('/reqstore', 'user\userController@reqstore');
 Route::get('/cheak/{id}', 'user\userController@cheak');
 Route::post('cheak/{id}/update', 'user\userController@cheakupdate');
 Route::get('/new', 'user\userController@new');
 Route::get('/old', 'user\userController@old');
 Route::get('req/{id}', 'user\userController@reqinf');
 Route::get('req/{id}/flow', 'user\userController@flow');
 Route::post('req/{id}/fin', 'user\userController@cupdate');
 Route::get('req/{id}/reat', 'user\userController@reat');
 Route::post('/reatestore/{id}', 'user\userController@reatestore');
 Route::post('provider/{id}', 'user\userController@favstore');
 Route::get('/fav', 'user\userController@fav');
 Route::get('/nots', 'user\userController@Not');
 Route::get('nots/{id}', 'user\userController@ndestroy');
 Route::get('/orders', 'user\userController@orders');
 Route::get('profile/{id}', 'user\userController@userprofile');
 Route::post('edit/profile/{id}', 'user\userController@updateprofile');
 Route::post('edit/pass/{id}', 'user\userController@uupdate');
 Route::post('/umstore', 'user\userController@umstore');
 Route::post('logout', 'auth\LoginController@logout');
});

 Route::group(['middleware' => ['auth:prov-api'], 'namespace' => 'Api'], function (){
 /*provider */

 Route::get('/start', 'user\provController@start');
 Route::get('/bank', 'user\provController@bank');
 Route::get('bank/{id}', 'user\provController@banks');
 Route::post('start/{id}', 'user\provController@bstore');
 Route::get('prov/req/{id}', 'user\provController@reqinf');
 Route::get('prov/req/{id}/flow', 'user\provController@flow');
 Route::post('/sucs/{id}', 'user\provController@rupdate');
 Route::get('/dis/{id}/why', 'user\provController@dis');
 Route::post('/dis/{id}', 'user\provController@dupdate');
 Route::get('prov/nots', 'user\provController@pNot');
 Route::get('prov/nots/{id}', 'user\provController@pndestroy');
 Route::get('prov/new', 'user\provController@pnew');
 Route::get('prov/old', 'user\provController@pold');
 Route::get('servs', 'user\provController@servindex');
 Route::post('servs', 'user\provController@servstore');
 Route::get('servs/{id}/edit', 'user\provController@servedit');
 Route::post('servs/{id}', 'user\provController@servupdate');
 Route::get('servs/{id}', 'user\provController@servdestroy');
 Route::get('prov/profile/{id}', 'user\provController@profile');
 Route::post('prov/edit/profile/{id}', 'user\provController@uprofile');
 Route::get('prov/pass/{id}', 'user\provController@pass');
 Route::post('prov/edit/pass/{id}', 'user\provController@pupdate');
 Route::post('prov/content', 'user\provController@pmstore');
 
});

Route::group(['namespace' => 'Api'], function (){

    Route::post('login', 'auth\LoginController@login');
    Route::post('prov/login', 'auth\ProvLoginController@login');
    Route::post('password/email', 'auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('prov/password/email', 'auth\provForgotPasswordController@sendResetLinkEmail');
     Route::post('register', 'auth\RegisterController@register');
     Route::post('prov/register', 'auth\ProvRegisterController@createProv');
    });
