<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/'], function () {
    Route::get('/', 'HomeController')->name('home');

    Route::group(['prefix' => 'usuarios'], function () {
        Route::get('/', 'UserController@index')->name('users.index');
        Route::get('/cadastrar', 'UserController@create')->name('users.create');
        Route::get('/{id}', 'UserController@getUser')->name('users.getUser');
        Route::post('/', 'UserController@store')->name('users.store');
        Route::put('/{id}', 'UserController@update')->name('users.update');
        Route::delete('/{id}', 'UserController@destroy')->name('users.destroy');
    });

});
