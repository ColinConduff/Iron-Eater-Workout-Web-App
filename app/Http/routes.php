<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function()
{
    return view('home');
});

Route::get('/home', function()
{
    return view('home');
});

Route::get('edit/{id}', [
	'middleware' => 'auth', 
	'uses' => 'DashboardController@edit'
]);

Route::get('dashboard', [
	'middleware' => 'auth', 
	'uses' => 'DashboardController@displayDashboard'
]);

Route::post('startNewWorkout', [
	'middleware' => 'auth', 
	'uses' => 'SessionController@startNewWorkout'
]);

Route::get('exercises/titleAsc', [
	'middleware' => 'auth', 
	'uses' => 'ExerciseController@sortTitleAsc'
]);

Route::get('exercises/titleDesc', [
	'middleware' => 'auth', 
	'uses' => 'ExerciseController@sortTitleDesc'
]);

Route::get('exercises/type/{type}', 'ExerciseController@filterByType');
Route::get('exercises/category/{category}', 'ExerciseController@filterByCategory');

Route::post('filterByExerciseTitle', [
	'middleware' => 'auth', 
	'uses' => 'SessionController@sendExerciseID'
]);
Route::get('filterByExerciseTitle/{id}', [
	'middleware' => 'auth', 
	'uses' => 'SessionController@filterByExerciseTitle'
]);

Route::post('filterByWorkoutTitle', [
	'middleware' => 'auth', 
	'uses' => 'SessionController@sendWorkoutID'
]);
Route::get('filterByWorkoutTitle/{id}', [
	'middleware' => 'auth', 
	'uses' => 'SessionController@filterByWorkoutTitle'
]);

Route::resource('exercises', 'ExerciseController', 
	['except' => ['create']]);
Route::resource('workouts', 'WorkoutController', 
	['except' => ['index','create']]);
Route::resource('sessions', 'SessionController', 
	['except' => ['create']]);
Route::resource('sessionSets', 'SessionSetController', 
	['except' => ['index','create','show','edit']]);

// Authentication routes... 
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');