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

Route::group(array('before' => 'auth.staff'), function(){

	Route::get('/form/{id}/print', array(
		'uses' => 'FormController@pdf',
		'as'   => 'form.print'
	));

	Route::get('/form/review', array(
		'uses' => 'FormController@review',
		'as'   => 'form.review'
	));


	Route::get('/form/{id}/edit', array(
		'uses' => 'FormController@edit',
		'as'   => 'form.edit'
	));

	Route::put('/form/submit', array(
		'uses' => 'FormController@submit',
		'as'   => 'form.submit'
	));

	Route::get('/staff/password', array(
		'uses' => 'FormController@password',
		'as'   => 'staff.password'
	));

	Route::put('/staff/password', array(
		'uses' => 'FormController@updatePassword',
		'as'   => 'staff.password.update'
	));

	Route::resource('form', 'FormController', array(
		'only'   => ['index', 'show', 'store', 'create']
	));

	Route::post('/form/upload/{field}', array(
		'uses' => 'FormController@upload',
		'as'   => 'form.upload'
	));	

	Route::post('/form/upload/{field}/{id}', array(
		'uses' => 'FormController@uploadEdit',
		'as'   => 'form.upload.edit'
	));	

	Route::post('/form/{id}/edit', array(
		'uses' => 'FormController@update',
		'as'   => 'form.update'
	));

	Route::delete('/form/remove/{field}', array(
		'uses' => 'FormController@removeUpload',
		'as'   => 'form.upload.remove'
	));

	Route::delete('/form/remove/{field}/{id}', array(
		'uses' => 'FormController@removeUploadEdit',
		'as'   => 'form.upload.remove.edit'
	));

});

Route::group(array('before' => 'auth'), function(){

	Route::get('/entries', array(
		'uses' => 'EntryController@index',
		'as'   => 'entries.index'
	));
	Route::get('/entries/import', array(
		'uses' => 'EntryController@import',
		'as'   => 'entries.import'
	));
	Route::post('/entries/import', array(
		'uses' => 'EntryController@processImport',
		'as'   => 'entries.import.process'
	));
	Route::get('/entries/{id}/email', array(
		'uses' => 'EntryController@email',
		'as'   => 'entries.email'
	));
	Route::post('/entries/{id}/email', array(
		'uses' => 'EntryController@processEmail',
		'as'   => 'entries.email.process'
	));
	Route::get('/entries/{id}/print', array(
		'uses' => 'EntryController@pdf',
		'as'   => 'entries.print'
	));	
	Route::get('/entries/{id}/preview', array(
		'uses' => 'EntryController@preview',
		'as'   => 'entries.preview'
	));
	Route::get('/entries/{id}', array(
		'uses' => 'EntryController@show',
		'as'   => 'entries.show'
	));
	Route::post('/entries/{id}/comments', array(
		'uses' => 'EntryController@comments',
		'as'   => 'entries.comments'
	));

	Route::resource('users', 'UserController', [
		'except' => ['show']
	]);

});

Route::get('/', array(
	'uses' => 'HomeController@index',
	'as'   => 'staff.login'
));

Route::get('/staff/forgot', array(
	'uses' => 'HomeController@forgot',
	'as'   => 'staff.forgot'
));

Route::post('/staff/forgot', array(
	'uses' => 'HomeController@forgotAction',
	'as'   => 'staff.forgot.action'
));

Route::post('/staff/login', array(
	'uses' => 'HomeController@loginAction',
	'as'   => 'staff.login.action'
));

Route::get('/register', array(
	'uses' => 'HomeController@register',
	'as'   => 'register'
));

Route::post('/register', array(
	'uses' => 'HomeController@registerAction',
	'as'   => 'register.action'
));

Route::get('/staff/logout', array(
	'uses' => 'HomeController@logout',
	'as'   => 'staff.logout'
));

Route::get('/logout', array(
	'uses' => 'LoginController@logout',
	'as'   => 'logout'
));

Route::get('/login', array(
	'uses' => 'LoginController@index',
	'as'   => 'login'
));

Route::post('/login', array(
	'uses' => 'LoginController@action',
	'as'   => 'login.action'
));

Route::get('/login/amnesia', array(
	'uses' => 'RemindersController@getRemind',
	'as'   => 'login.forgot'
));

Route::post('/login/amnesia', array(
	'uses' => 'RemindersController@postRemind',
	'as'   => 'login.forgot.action'
));

Route::get('/login/reset/{token}', array(
	'uses' => 'RemindersController@getReset',
	'as'   => 'login.reset'
));

Route::post('/login/reset', array(
	'uses' => 'RemindersController@postReset',
	'as'   => 'login.reset.action'
));
