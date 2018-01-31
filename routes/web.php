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

Route::get('reset_password/{token}', ['as' => 'password.reset', function($token)
{
    // implement your reset password route here!
}]);

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', function () {
    return view('customer/login');
});

Route::group(['prefix'=>'customer'],function(){
	Route::get('add',['as'=>'customer.add','uses'=>'CustomerController@getadd']);
	Route::get('list',['as'=>'customer.list','uses'=>'CustomerController@getlist']);
	Route::get('edit/{id}',['as'=>'customer.edit','uses'=>'CustomerController@getedit']);
	Route::get('detail/{id}',['as'=>'customer.detail','uses'=>'CustomerController@getdetail']);
});

Route::group(['prefix'=>'ticket'],function(){
    Route::get('add',['as'=>'ticket.add','uses'=>'TicketController@getadd']);
    Route::get('list',['as'=>'ticket.list','uses'=>'TicketController@getlist']);
    Route::get('detail/{id}',['as'=>'ticket.detail','uses'=>'TicketController@getdetail']);
});


