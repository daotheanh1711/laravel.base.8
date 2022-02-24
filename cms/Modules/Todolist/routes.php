<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'admin/todolist',
    'namespace' => 'Cms\Modules\Todolist\Controllers',
    'middleware' => ['web' , 'auth'],
], function () {
    Route::get('/', 'TodolistController@index')->name('todolist.index');
    Route::get('/create', 'TodolistController@create')->name('todolist.create');
    Route::post('/', 'TodolistController@save')->name('todolist.save');
    Route::delete('/{id}', 'TodolistController@delete')->name('todolist.delete');
    Route::get('/{id}', 'TodolistController@detail')->name('todolist.detail');
    Route::post('/{id}', 'TodolistController@update')->name('todolist.update');
});

Route::group([
    'prefix' => '/todolist',
    'namespace' => 'Cms\Modules\Todolist\Controllers',
    'middleware' => ['web' , 'auth'],
],function() {
    Route::get('/', 'TodolistController@indexTest');
});
