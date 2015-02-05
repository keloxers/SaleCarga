<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
App::setLocale('es');


// Session Routes
Route::get('login',  array('as' => 'login', 'uses' => 'SessionController@create'));
Route::get('logout', array('as' => 'logout', 'uses' => 'SessionController@destroy'));
Route::resource('sessions', 'SessionController', array('only' => array('create', 'store', 'destroy')));

// User Routes
Route::get('register', 'UserController@create');
Route::get('users/{id}/activate/{code}', 'UserController@activate')->where('id', '[0-9]+');
Route::get('resend', array('as' => 'resendActivationForm', function()
{
	return View::make('users.resend');
}));
Route::post('resend', 'UserController@resend');
Route::get('forgot', array('as' => 'forgotPasswordForm', function()
{
	return View::make('users.forgot');
}));
Route::post('forgot', 'UserController@forgot');
Route::post('users/{id}/change', 'UserController@change');
Route::get('users/{id}/reset/{code}', 'UserController@reset')->where('id', '[0-9]+');
Route::get('users/{id}/suspend', array('as' => 'suspendUserForm', function($id)
{
	return View::make('users.suspend')->with('id', $id);
}));
Route::post('users/{id}/suspend', 'UserController@suspend')->where('id', '[0-9]+');
Route::get('users/{id}/unsuspend', 'UserController@unsuspend')->where('id', '[0-9]+');
Route::get('users/{id}/ban', 'UserController@ban')->where('id', '[0-9]+');
Route::get('users/{id}/unban', 'UserController@unban')->where('id', '[0-9]+');
Route::resource('users', 'UserController');


// Group Routes
Route::resource('groups', 'GroupController');


App::missing(function($exception)
{
		return Response::view('pages.404');
});


Route::get('/search/ciudads', 'SearchController@ciudads');

// Index
Route::get( '/', array(
		'as' => 'ofertas.home',
		'uses' => 'OfertasController@home'
) );



# Standard User Routes
Route::group(['before' => 'auth|standardUser'], function()
{

		Route::resource('contactos', 'ContactosController');
		Route::get('/contactos/{id}/delete', 'ContactosController@destroy');


		Route::resource('archivos', 'ArchivosController');


		Route::get('/archivos/{id}/delete', 'ArchivosController@destroy');


		Route::resource('pages', 'PagesController');

		Route::get('/pages/{id}/delete', 'PagesController@destroy');

		Route::resource('banners', 'BannersController');
		Route::get('/banners/{id}/delete', 'BannersController@destroy');


		Route::resource('ofertas', 'OfertasController');


});


Route::get('/pages/{url_seo}', 'PagesController@show');

Route::get('/ofertas/show/{url_seo}', 'OfertasController@show');
Route::get('/ofertas/tiposcargas/{tiposcarga}', 'OfertasController@showtiposcargas');
