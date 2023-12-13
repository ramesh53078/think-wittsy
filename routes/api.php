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

// Route::fallback(function () {
//     return response()->json(['error' => 'Method not allowed.'], 405);
// });


Route::post('/sign-up','Api\RegisterController@register');

Route::post('/sign-in','Api\LoginController@login');
Route::post('otp-login','Api\LoginController@otpLogin');
Route::post('/verify-otp','Api\LoginController@verifyOTP');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('update-profile','Api\ProfileController@updateProfile');    
    Route::post('/feedback','Api\FeedbackController@Feedback');
    });
