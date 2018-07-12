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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/homeb', 'HomeController@indexb')->name('homeb');
Route::get('/home/show', 'HomeController@show')->name('home.show');
Route::get('/home/showb', 'HomeController@showb')->name('home.showb');
Route::get('/home/edit', 'HomeController@edit')->name('home.edit');
Route::get('/home/update', 'HomeController@update')->name('home.update');
Route::post('/home/store', 'HomeController@store')->name('home.store');

/*grupo de rutas*/
Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
  });


Route::get('/equipo', 'EquipoController@index')->name('equipo.index');
Route::post('/equipo', 'EquipoController@store');
Route::get('/equipo/edit', 'EquipoController@edit')->name('equipo.edit');
Route::post('/equipo/update', 'EquipoController@update')->name('equipo.update');
Route::post('equipo/destroy', 'EquipoController@destroy')->name('equipo.destroy');


Route::get('/grupo', 'GrupoController@index')->name('grupo.index');
// Route::post('/grupo', 'GrupoController@store');
Route::get('/grupo/edit', 'GrupoController@edit')->name('grupo.edit');
Route::get('/grupo/create', 'GrupoController@create')->name('grupo.create');
Route::post('/grupo/store', 'GrupoController@store')->name('grupo.store');
Route::post('/grupo/update', 'GrupoController@update')->name('grupo.update');
Route::post('grupo/destroy', 'GrupoController@destroy')->name('grupo.destroy');

Route::get('/partido', 'PartidoController@index')->name('partido.index');
// Route::post('/partido', 'PartidoController@store');
Route::get('/partido/edit', 'PartidoController@edit')->name('partido.edit');
Route::get('/partido/create', 'PartidoController@create')->name('partido.create');
Route::get('/partido/selpartido', 'PartidoController@selpartido')->name('partido.selpartido');
Route::post('/partido/store', 'PartidoController@store')->name('partido.store');
Route::post('/partido/update', 'PartidoController@update')->name('partido.update');
Route::post('partido/destroy', 'PartidoController@destroy')->name('partido.destroy');

Route::get('/partido2', 'PartidoControllerb@index')->name('partido2.index');
// Route::post('/partido', 'PartidoController@store');
Route::get('/partido2/edit', 'PartidoControllerb@edit')->name('partido2.edit');
Route::get('/partido2/create', 'PartidoControllerb@create')->name('partido2.create');
Route::get('/partido2/selpartido', 'PartidoControllerb@selpartido')->name('partido2.selpartido');
Route::post('/partido2/store', 'PartidoControllerb@store')->name('partido2.store');
Route::post('/partido2/update', 'PartidoControllerb@update')->name('partido2.update');
Route::post('partido2/destroy', 'PartidoControllerb@destroy')->name('partido2.destroy');

Route::get('/grupoPicture', 'GrupoPictureController@index')->name('grupoPicture.index');
Route::get('/grupoPicture/show', 'GrupoPictureController@show')->name('grupoPicture.show');
Route::get('/grupoPicture/showp', 'GrupoPictureController@showp')->name('grupoPicture.showp');


Route::get('/apuesta', 'ApuestaController@index')->name('apuesta.index');
Route::get('apuesta/edit', 'ApuestaController@edit')->name('apuesta.edit');
Route::get('/apuesta2', 'ApuestaControllerb@index')->name('apuesta2.index');
Route::get('apuesta2/edit', 'ApuestaControllerb@edit')->name('apuesta2.edit');
//Route::get('apuesta2/store', 'ApuestaControllerb@store')->name('apuesta2.store');

//para ionic

Route::get('/partido/show', 'PartidoController@show')->name('partido.show');

Route::get('create_paypal_plan', 'PaypalController@create_plan');
Route::get('paywithpaypal', array('as' => 'addmoney.paywithpaypal','uses' => 'AddMoneyController@payWithPaypal',));
Route::post('paypal', array('as' => 'addmoney.paypal','uses' => 'AddMoneyController@postPaymentWithpaypal',));
Route::get('paypal', array('as' => 'payment.status','uses' => 'AddMoneyController@getPaymentStatus',));

