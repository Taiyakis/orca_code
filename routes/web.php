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
    return view('encode');
});
Route::get('/test', function () {
    return "HELLO";
});

Route::post('/', 'Encoder@msgEncode');
Route::get('/delete', 'Decoder@deleteMsg');
Route::get('/index', 'Decoder@msgDecoder');

