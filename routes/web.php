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

//Perfil de usuario
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::post('/profile/update', 'ProfileController@updateProfile')->name('profile.update');
Route::get('/changepassword','ProfileController@showchangepasswordform')->name('profile.showchangepasswordform');
Route::post('/changepassword','ProfileController@changepassword')->name('profile.changepassword');

Route::get('/documentation', 'HomeController@documentation')->name('documentation.index');

Route::middleware(['auth'])->group(function () {

Route::get('roles', 'RoleController@index')->name('roles.index')->middleware('permission:roles.roles');
Route::post('roles/store', 'RoleController@store')->name('roles.store')->middleware('permission:roles.roles');
Route::put('roles/{role}', 'RoleController@update')->name('roles.update')->middleware('permission:roles.roles');
Route::post('roles', 'RoleController@storepermission')->name('roles.storepermission')->middleware('permission:roles.roles');
Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy')->middleware('permission:roles.roles');
Route::delete('permission/{permission}', 'RoleController@destroypermission')->name('roles.destroypermission')->middleware('permission:roles.roles');

Route::get('users', 'UserController@index')->name('users.index')->middleware('permission:roles.roles');
Route::put('users/{user}', 'RoleController@assignrole')->name('roles.assignrole')->middleware('permission:roles.roles');
Route::delete('users/{users}', 'RoleController@destroyuser')->name('roles.destroyuser')->middleware('permission:roles.roles');

Route::get('activity', 'RoleController@activityindex')->name('activity.index')->middleware('permission:roles.roles');

//Tareas
Route::get('task', 'TaskController@index')->name('task.index')->middleware('permission:task.task');
Route::post('task', 'TaskController@store')->name('task.store')->middleware('permission:task.task');
Route::put('task/{id}', 'TaskController@update')->name('task.update')->middleware('permission:task.task');
Route::get('admin_task', 'RoleController@task')->name('role.task')->middleware('permission:roles.roles');
Route::put('admin_task/{id}', 'RoleController@develop')->name('task.develop')->middleware('permission:roles.roles');

Route::get('users/export/', 'UserController@export')->name('users.export')->middleware('permission:roles.roles');
Route::post('import', 'UserController@import')->name('users.import')->middleware('permission:roles.roles');

});