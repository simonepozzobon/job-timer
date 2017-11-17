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

    Route::get('/projects', 'Api\ProjectController@get_projects');
    Route::post('/projects/set-main', 'Api\ProjectController@set_main');


    //
    // TODOS
    //
    Route::prefix('todo')->group(function() {
      Route::post('/add', 'TodoController@create');
      Route::post('/destroy', 'TodoController@destroy');
      Route::post('/update', 'TodoController@update');

      Route::post('/archive', 'TodoController@archive');
      Route::post('/unarchive', 'TodoController@unarchive');
      Route::post('/order', 'TodoController@order');

      Route::post('/category/new', 'CategoryController@create');
    });

    //
    // TIMERS
    //
    Route::post('/timer/play', 'TimerController@play');
    Route::post('/timer/pause', 'TimerController@pause');

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
