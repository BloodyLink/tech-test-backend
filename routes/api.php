<?php

use Illuminate\Http\Request;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::post('login', 'UserController@login'); 
Route::post('register', 'UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'UserController@details');

});

Route::post('logout','UserController@logoutApi');