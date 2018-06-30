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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
})->name('main');

Route::get('form', 'FormController@index')->name('home.form');
Route::post('form', 'FormController@store')->name('home.form.store');

Route::get('thank-you', function () {
    	return view('file.acknowledgement');
})->name('thanks');

Route::resource('file', 'FileController');
Route::get('myfile', 'FileController@myFile')->name('file.myfile');

Route::resource('task', 'TaskController')->middleware('role:admin,rm');

Route::get('assign-task/{program_id}/{client}', 'TaskController@assignClient')->name('assign.task')->middleware('role:admin,rm,accountant');
Route::get('assign-group-task/{program_id}/{client}', 'TaskController@assignGroupClient')->name('assign.group.task')->middleware('role:admin,rm,accountant');
Route::post('assign-task/{program_id}/{client_id}', 'TaskController@storeClientTasks')->name('store.client.task')->middleware('role:admin,rm,accountant');
Route::post('upload/{program_id}/{client_id}', 'TaskController@storeFiles')->name('upload.files');
Route::get('group/{program_id}', 'TaskController@taskGroup')->name('task.group');
Route::post('group/{client_id}/{program_id}', 'TaskController@taskGroupStore')->name('task.group.store');
Route::post('group-table/{program_id}', 'TaskController@taskTableGroupStore')->name('task.table.group.store');
Route::post('individual-tasks/{client_id}/{program_id}', 'TaskController@storeIndividualTasks')->name('task.add.individual');

Route::resource('client', 'ClientController')->middleware('role:admin,rm,accountant,operation');
Route::get('mytasks/{program_id}/{client_id}', 'ClientController@mytasks')->name('client.mytasks');
Route::get('myprograms/{client_id}', 'ClientController@myPrograms')->name('client.myprograms');
Route::get('profile/{client_id}', 'ClientController@profile')->name('client.profile');
Route::get('view-tasks/{client_id}/{program_id}', 'ClientController@clientTasks')->name('client.tasks.all');
Route::get('programs/{client_id}', 'ClientController@programs')->name('client.programs');
Route::post('complete-group/{client_id}/{program_id}', 'ClientController@completeGroupStore')->name('client.group.complete.store');

Route::get('home', 'HomeController@home')->name('home');
Route::get('dashboard', 'HomeController@index')->name('dashboard');
Route::get('users', 'HomeController@users')->name('users')->middleware('role:admin');
Route::post('users/{id}', 'HomeController@updateUserRole')->name('users.update.role')->middleware('role:admin');
Route::post('users/{id}', 'HomeController@updateUserRole')->name('users.update.role')->middleware('role:admin');
Route::get('user-create', 'HomeController@createUser')->name('user.create');
Route::post('user-create', 'HomeController@storeUser')->name('user.store');
Route::post('register-staff', 'HomeController@customStaffRegister')->name('staff.store');


Route::get('test', 'FileController@test')->name('test');
Route::post('additional-info', 'FileController@storeAddition')->name('store.addition');
Route::post('additional-test', 'FileController@storeTest')->name('store.test');

Route::get('invoice', function () {
    return view('invoice.index');
});

Route::resource('rms', 'RmController');

Route::get('getClientCounsellors', 'ClientController@getClientCounsellor');


