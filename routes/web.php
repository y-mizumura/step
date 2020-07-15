<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// MissionController
Route::get('/missions/create', 'MissionController@showCreateForm')->name('missions.create');
Route::post('/missions/create', 'MissionController@create');
Route::post('/missions/{mission}/edit', 'MissionController@edit')->name('missions.edit');
Route::post('/missions/{mission}/delete', 'MissionController@delete')->name('missions.delete');

// StepController
Route::get('/missions/{mission}/steps', 'StepController@index')->name('steps.index');
Route::get('/missions/{mission}/steps/create', 'StepController@showCreateForm')->name('steps.create');
Route::post('/missions/{mission}/steps/create', 'StepController@create');
Route::get('/missions/{mission}/steps/{step}/edit', 'StepController@showEditForm')->name('steps.edit');
Route::post('/missions/{mission}/steps/{step}/edit', 'StepController@edit');
Route::post('/missions/{mission}/steps/{step}/delete', 'StepController@delete')->name('steps.delete');
