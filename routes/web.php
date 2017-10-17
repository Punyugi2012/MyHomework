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
    return view('templates.template');
});
Route::get('/year', 'MyHomeworkController@onYearsList');
Route::get('/year/{year}/term', 'MyHomeworkController@onTermsList');
Route::get('/term/{term}/subject', 'SubjectController@onSubjectsList');
Route::get('/add-subject', 'SubjectController@addSubject');
Route::delete('/delete-subject/{id}', 'SubjectController@deleteSubject');
Route::put('/edit-subject/{id}', 'SubjectController@editSubject');
Route::get('/subject/{subject}/homework', 'HomeworkController@onHomeworkList');
Route::get('/add-homework', 'HomeworkController@addHomework');
Route::put('/edit-homework/{id}', 'HomeworkController@editHomework');
Route::delete('/delete-homework/{id}', 'HomeworkController@deleteHomework');
Route::get('/homework/{homeworkId}/links', 'LinkController@onLinkList');
Route::get('/add-link', 'LinkController@addLink');
Route::delete('/delete-link/{id}', 'LinkController@deleteLink');
Route::put('/edit-link/{id}', 'LinkController@editLink');