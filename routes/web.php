<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/artikel', 'App\Http\Controllers\ArticleController@index');
Route::get('/artikel/{slug}', 'App\Http\Controllers\ArticleController@show');