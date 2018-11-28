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

Route::get('/admin', 'AdmindashboardController@index')->middleware('adminmiddleware');

Route::get('/user', 'UserController@index');

Route::get('/adminlogout', function(){
   Auth::logout();
   return Redirect::to('/');
});

//projects route

Route::get('/projects', 'ProjectsController@projects_list');

Route::get('/project', 'ProjectsController@project');

Route::post('/project', 'ProjectsController@store');

Route::get('/project/{id}', 'ProjectsController@project');

Route::patch('/project-update/{id}', 'ProjectsController@update');

Route::get('/project-delete/{id}', 'ProjectsController@delete');

Route::get('project-pagination','ProjectsController@pagination');

Route::post('projects-delete','ProjectsController@bulkdelete');

//task route

Route::get('task', function(){
    return view('backend.task');
});

Route::post('task-insert', 'TaskController@store');

//learning

Route::get('autocomplete', 'ProjectsController@autocomplete'); //http://localhost/zcamp/public/autocomplete
Route::post('autocomplete-fetch', 'ProjectsController@autocompletefetch');
