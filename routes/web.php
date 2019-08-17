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

Route::middleware(['auth'])->group(function () {

Route::get('roles', 'RoleController@index')->name('roles.index')
	->middleware('permission:roles.roles');
Route::post('roles/store', 'RoleController@store')->name('roles.store')
	->middleware('permission:roles.roles');
Route::put('roles/{role}', 'RoleController@update')->name('roles.update')
	->middleware('permission:roles.roles');
Route::post('roles', 'RoleController@storepermission')->name('roles.storepermission')
	->middleware('permission:roles.roles');
Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy')
	->middleware('permission:roles.roles');
Route::delete('permission/{permission}', 'RoleController@destroypermission')->name('roles.destroypermission')
	->middleware('permission:roles.roles');
Route::put('users/{user}', 'RoleController@assignrole')->name('roles.assignrole')
	->middleware('permission:roles.roles');
Route::delete('users/{users}', 'RoleController@destroyuser')->name('roles.destroyuser')
	->middleware('permission:roles.roles');
});