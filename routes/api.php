<?php namespace App\Http\Controllers;

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

Route::get('/', function () {
    return 'Help';
});


// Routes for Auth - Module
Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::middleware('auth:api')->group(function ()
{
    Route::get('user', 'UserController@index');
    Route::get('logout', 'UserController@logout');
});
