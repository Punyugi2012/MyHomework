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
Route::get('/years', 'MyHomeworkController@onYearsList');
Route::get('/year/{year}/terms', 'MyHomeworkController@onTermsList');
Route::get('/year/{year}/term/{term}/subjects', 'SubjectController@onSubjectsList');
Route::post('/add-subject', 'SubjectController@addSubject');
Route::delete('/delete-subject/{id}', 'SubjectController@deleteSubject');
Route::put('/edit-subject/{id}', 'SubjectController@editSubject');
Route::get('/year/{year}/term/{term}/subject/{id}/homeworks', 'HomeworkController@onHomeworkList');
Route::post('/add-homework/{subjectId}', 'HomeworkController@addHomework');
Route::put('/edit-homework/{id}', 'HomeworkController@editHomework');
Route::delete('/delete-homework/{id}', 'HomeworkController@deleteHomework');
Route::get('homework/{homeworkId}/links', 'LinkController@onLinkList');