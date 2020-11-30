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

Route::get('/', function () {
    return view('welcome');
});
Route::namespace('backend')->prefix('admin')->group(function (){
    
    Route::get('/', 'AdminController@index')->name('home.index');

    Route::get('home', 'home@index')->name('home.index');
    Route::get('/', 'home@index')->name('home.index');


    Route::get('sections', 'sections@index')->name('sections.index');
    Route::get('sections/create', 'sections@create')->name('sections.create');
    Route::post('sections', 'sections@store')->name('sections.store');
    Route::get('sections/{id}/edit', 'sections@edit')->name('sections.edit');
    Route::put('sections/{id}', 'sections@update')->name('sections.update');
    Route::delete('sections/{id}', 'sections@destroy')->name('sections.destroy');



    
    Route::get('cities', 'cities@index')->name('cities.index');
    Route::get('cities/create', 'cities@create')->name('cities.create');
    Route::post('cities', 'cities@store')->name('cities.store');
    Route::get('cities/{id}/edit', 'cities@edit')->name('cities.edit');
    Route::put('cities/{id}', 'cities@update')->name('cities.update');
    Route::delete('cities/{id}', 'cities@destroy')->name('cities.destroy');



    Route::get('providers', 'providers@index')->name('providers.index');
    Route::get('providers/create', 'providers@create')->name('providers.create');
    Route::post('providers', 'providers@store')->name('providers.store');
    Route::get('providers/{id}/edit', 'providers@edit')->name('providers.edit');
    Route::put('providers/{id}', 'providers@update')->name('providers.update');
    Route::delete('providers/{id}', 'providers@destroy')->name('providers.destroy');


    
    Route::get('users', 'users@index')->name('users.index');
    Route::get('users/create', 'users@create')->name('users.create');
    Route::post('users', 'users@store')->name('users.store');
    Route::get('users/{id}/edit', 'users@edit')->name('users.edit');
    Route::put('users/{id}', 'users@update')->name('users.update');
    Route::delete('users/{id}', 'users@destroy')->name('users.destroy');


    Route::get('banks', 'banks@index')->name('banks.index');
    Route::get('banks/create', 'banks@create')->name('banks.create');
    Route::post('banks', 'banks@store')->name('banks.store');
    Route::get('banks/{id}/edit', 'banks@edit')->name('banks.edit');
    Route::put('banks/{id}', 'banks@update')->name('banks.update');
    Route::delete('banks/{id}', 'banks@destroy')->name('banks.destroy');

    Route::get('trans', 'transes@index')->name('trans.index');
    Route::get('trans/{id}/edit', 'transes@edit')->name('trans.edit');
    Route::put('trans/{id}', 'transes@update')->name('trans.update');
    Route::delete('trans/{id}', 'transes@destroy')->name('trans.destroy');

    Route::get('ums', 'msgs@index')->name('ums.index');
    Route::delete('ums/{id}', 'msgs@destroy')->name('ums.destroy');

    Route::get('pms', 'pmsms@index')->name('pms.index');
    Route::delete('pms/{id}', 'pmsms@destroy')->name('pms.destroy');
});




Route::namespace('providers')->group(function (){

    Route::get('/start', 'ProvController@start')->name('start');


    Route::get('/about', 'ProvController@about')->name('about');
    Route::get('/cond', 'ProvController@cond')->name('cond');
    Route::get('/wallet', 'ProvController@wallet')->name('wallet');
    Route::get('/bank', 'ProvController@bank')->name('bank');
    Route::get('servs', 'ProvController@servindex')->name('servs.index');
    Route::get('servs/create', 'ProvController@servcreate')->name('servs.create');
    Route::post('servs', 'ProvController@servstore')->name('servs.store');
    Route::get('servs/{id}/edit', 'ProvController@servedit')->name('servs.edit');
    Route::put('servs/{id}', 'ProvController@servupdate')->name('servs.update');
    Route::delete('servs/{id}', 'ProvController@servdestroy')->name('servs.destroy');

    Route::get('prov/req/{id}', 'ProvController@reqinf')->name('prov.req');
    Route::get('prov/req/{id}/flow', 'ProvController@flow')->name('flow.prov');
    Route::get('/sucs/{id}', 'ProvController@sucs')->name('sucs');
    Route::put('/sucs/{id}', 'ProvController@rupdate')->name('sucs.update');
    Route::get('/dis/{id}/why', 'ProvController@dis')->name('dis');
    Route::put('/dis/{id}', 'ProvController@dupdate')->name('dis.update');
    Route::get('prov/new', 'ProvController@pnew')->name('pnew');
    Route::get('prov/old', 'ProvController@pold')->name('pold');

    
Route::get('prov/profile/{id}/{slug?}', 'ProvController@profile')->name('prov.profile');

Route::put('prov/edit/profile/{id}/{slug?}', 'ProvController@uprofile')->name('update.profile');

    
Route::get('prov/pass/{id}/{slug?}', 'ProvController@pass')->name('prov.pass');

Route::put('prov/edit/pass/{id}/{slug?}', 'ProvController@pupdate')->name('update.pass');

Route::get('bank/{id}', 'ProvController@banks')->name('front.banks');
Route::post('start/{id}', 'ProvController@bstore')->name('pay.store');


Route::get('prov/nots', 'ProvController@pNot')->name('pnots');
Route::delete('prov/nots/{id}', 'ProvController@pndestroy')->name('pnots.destroy');
Route::delete('prov/nots', 'ProvController@pandestroy')->name('panots.destroy');

Route::get('prov/content', 'ProvController@pms')->name('pcontent');
Route::post('prov/content', 'ProvController@pmstore')->name('pcontent.store');

Route::post('start', 'ProvController@index2')->name('save.ptoken');
    
});

Auth::routes();
Route::get('prov/login', function () {return view('auth.prov-login');})->name('prov.login');
Route::post('prov/login', 'Auth\PrvLoginController@login')->name('login.start');


Route::get('admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('admin/home', 'Auth\AdminLoginController@login')->name('admin.login.submit');

Route::get('prov/register', 'Auth\PrvRegisterController@showProvRegisterForm')->name('prov.register');
Route::post('prov/register', 'Auth\PrvRegisterController@createProv')->name('prov.reg.start');


 // Password reset routes
 Route::post('prov/password/email', 'Auth\provForgotPasswordController@sendResetLinkEmail')->name('prov.password.email');
 Route::get('prov/password/reset', 'Auth\provForgotPasswordController@showLinkRequestForm')->name('prov.password.request');
 Route::post('prov/password/reset', 'Auth\provResetPasswordController@reset');
 Route::get('prov/password/reset/{token}', 'Auth\provResetPasswordController@showResetForm')->name('prov.password.reset');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@home')->name('home');
Route::get('section/{id}', 'HomeController@section')->name('front.section');
Route::get('near/{id}', 'HomeController@near')->name('near.section');
Route::get('top/{id}', 'HomeController@top')->name('top.section');
Route::get('bottom/{id}', 'HomeController@bottom')->name('bottom.section');
Route::get('provider/{id}', 'HomeController@provider')->name('front.provider');

Route::get('/cheak/{id}', 'HomeController@cheak')->name('cheak');
Route::get('provider/{id}/requestin', 'HomeController@reqcreate')->name('reqsin.create');
Route::get('provider/{id}/requestout', 'HomeController@reqocreate')->name('reqsout.create');
Route::get('/show/{id}', 'HomeController@show')->name('reqs.show');
Route::post('/reqstore', 'HomeController@reqstore')->name('front.reqstore');
Route::put('cheak/{id}', 'HomeController@cheakupdate')->name('cheak.update');
Route::get('/new', 'HomeController@new')->name('new');
Route::get('/old', 'HomeController@old')->name('old');
Route::get('req/{id}', 'HomeController@reqinf')->name('front.req');
Route::get('req/{id}/flow', 'HomeController@flow')->name('flow.req');
Route::put('req/{id}/flow', 'HomeController@cupdate')->name('fin.update');

Route::get('req/{id}/reat', 'HomeController@reat')->name('front.reat');
Route::put('/reatestore/{id}', 'HomeController@reatestore')->name('reate.store');
Route::put('provider/{id}', 'HomeController@favstore')->name('fav.store');

Route::get('/fav', 'HomeController@fav')->name('fav');
Route::get('/orders', 'HomeController@orders')->name('orders');
Route::get('/nots', 'HomeController@Not')->name('nots');
Route::delete('nots/{id}', 'HomeController@ndestroy')->name('nots.destroy');
Route::delete('/nots', 'HomeController@andestroy')->name('anots.destroy');
  
Route::get('profile/{id}/{slug?}', 'HomeController@userprofile')->name('profile');

Route::put('edit/profile/{id}/{slug?}', 'HomeController@updateprofile')->name('update.profileuser');

    
Route::get('pass/{id}/{slug?}', 'HomeController@upass')->name('user.pass');

Route::put('edit/pass/{id}/{slug?}', 'HomeController@uupdate')->name('update.upass');

Route::get('/about', 'HomeController@about')->name('about');
Route::get('/cond', 'HomeController@cond')->name('cond');

Route::get('/content', 'HomeController@ums')->name('content');
Route::post('/home', 'HomeController@umstore')->name('content.store');

Route::post('/home', 'HomeController@index2')->name('save.token');
