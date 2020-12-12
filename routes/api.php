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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return "aa";
});
// START Admin hesgiin API
// Route::post('/show/admins', 'AdminController@getAdmins')->middleware('auth:api');
// END Admin hesgiin API
Route::group(['middleware' => 'auth:api'], function(){

    Route::post('/show/admins', 'AdminController@getAdmins')->middleware('auth:api');

});
