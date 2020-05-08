<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register','Api\AuthController@register')->middleware('auth:api');
Route::post('/login','Api\AuthController@login');
Route::resource('/animals','Api\AnimalController')->middleware('auth:api');
Route::resource('/reclamos','Api\ReclamoController')->middleware('auth:api');
Route::resource('/avistamientos','Api\AvistamientoController')->middleware('auth:api');
Route::resource('/reproduccions','Api\ReproduccionController')->middleware('auth:api');
Route::resource('/users','Api\UserController')->middleware('auth:api');
