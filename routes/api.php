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

Route::get('verified-only', function(Request $request){
   dd('you are verified', $request->user()->first_name);
})->middleware('auth:api', 'verified');


    // Routes for Auth - Module
    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');
    Route::get('user', 'UserController@index')->middleware('auth:api');
    Route::get('logout', 'UserController@logout')->middleware('auth:api');

    // Routes for Registration Verification Email
    Route::get('email/resend','VerificationController@resend')->name('verification.resend');
    Route::get('email/verify/{id}/{hash}','VerificationController@verify')->name('verification.verify');

    //Admin Panel
    Route::middleware(['auth:api','admin'])->group(function () {
        Route::get('admin',function (){
           return 'You are the best';
        });
    });
