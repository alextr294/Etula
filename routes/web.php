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

/**
 * Auto-generated authentication routes.
 */
Auth::routes();

/**
 * Homepage.
 */
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

/**
 * Admin Only
 */
    //==Teaching Unit==
    Route::resource('courses','TeachingUnitController');

/**
 * Teacher.
 */
Route::get('/teacher', function () {
    return view('teacher');
});

Route::get('lesson_create', 'LessonController@create');
Route::post('lesson_create', 'LessonController@postForm');

Route::get('token_create/{id}', [

    'as' => 'token_create',

    'uses' => 'TokenController@create',

 ]);
