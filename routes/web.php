<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/users'], function () {
    Route::get('/', 'UserController@index')->name('users.index');
    Route::get('/cadastrar', 'UserController@create')->name('users.create');
    Route::post('/', 'UserController@store')->name('users.store');
    Route::get('/{user}', 'UserController@show')->where(['id' => '[0-9]+'])->name('users.show');
    Route::get('/{user}/editar', 'UserController@edit')->where(['id' => '[0-9]+'])->name('users.edit');
    Route::put('/{user}', 'UserController@update')->where(['id' => '[0-9]+'])->name('users.update');
    Route::delete('/{user}', 'UserController@destroy')->where(['id' => '[0-9]+'])->name('users.destroy');
});
