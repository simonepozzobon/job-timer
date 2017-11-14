<?php

use Illuminate\Http\Request;

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

Route::prefix('v1')->group(function() {
    Route::post('/todo/add', 'TodoController@create');
    Route::post('/todo/destroy', 'TodoController@destroy');
    Route::post('/todo/update', 'TodoController@update');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
