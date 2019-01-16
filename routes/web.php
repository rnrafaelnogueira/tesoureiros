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
Route::resource('users', 'UsersController');
Route::resource('receitas', 'ReceitasController');
Route::resource('categorias', 'CategoriasController');
Route::resource('despesas', 'DespesasController');
Route::resource('pagamentos', 'PagamentosController');

Route::name('importxlsusers')->get('importxlsusers', 'UsersController@importxls');

Route::name('login')->get('login', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login');
