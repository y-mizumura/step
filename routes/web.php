<?php

use Illuminate\Support\Facades\Route;

// 会員登録・ログイン・ログアウト・パスワード再設定の各機能
Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    // HomeController
    Route::get('/', 'HomeController@index')->name('home');

    // MissionController
    Route::get('/missions', 'MissionController@index')->name('missions.index');
    Route::get('/missions/create', 'MissionController@showCreateForm')->name('missions.create');
    Route::post('/missions/create', 'MissionController@create');

    // MissionPolicy
    Route::group(['middleware' => 'can:view,mission'], function() {
        // MissionController
        Route::get('/missions/{mission}', 'MissionController@detail')->name('missions.detail');
        Route::get('/missions/{mission}/edit', 'MissionController@showEditForm')->name('missions.edit');
        Route::post('/missions/{mission}/edit', 'MissionController@edit');
        Route::post('/missions/{mission}/delete', 'MissionController@delete')->name('missions.delete');

        // StepController
        Route::post('/missions/{mission}/steps/create', 'StepController@create')->name('steps.create');
        Route::get('/missions/{mission}/steps/{step}/edit', 'StepController@showEditForm')->name('steps.edit');
        Route::post('/missions/{mission}/steps/{step}/edit', 'StepController@edit');
        Route::post('/missions/{mission}/steps/{step}/delete', 'StepController@delete')->name('steps.delete');
    });

});