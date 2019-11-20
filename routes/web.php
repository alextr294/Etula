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
Route::get('/home/student/{token?}', 'HomeController@index')->name('student_code_validation');

/**
 * Resources controllers.
 */


Route::resources([
    'users' => 'UserController',
    'courses' => 'TeachingUnitController',
    'lessons' => 'LessonController'
]);

/**
 * TokenController.
 */

/*Route::post('token_create/{id}', [
    'as' => 'token_create',
    'uses' => 'TokenController@create',
]);*/

Route::get('/lesson_student', 'LessonController@showLessonsStudent')->name('lesson_student');


Route::get('code/{id}', [

    'as' => 'code',

    'uses' => 'TokenController@create',

]);

Route::get('delete/{id}', [

    'as' => 'delete',

    'uses' => 'TokenController@delete',

]);

//Route::get('token_validate/{token}', 'TokenController@accept');

Route::post('token_validate', [
    'as' => 'token_validate',
    'uses' => 'TokenController@accept',
]);

Route::post('students_validate', [
    'as' => 'students_validate',
    'uses' => 'TokenController@acceptByTeacher',
]);

Route::post('teacher_add', [
    'as' => 'teacher_add',
    'uses' => 'LessonController@teacher_add',
]);