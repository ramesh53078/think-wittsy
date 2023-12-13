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
    return view('welcome');
});

Route::get('/admin-login', function () {

    return view('admin.login');
})->name('login');

Route::post('/admin/authentication', 'Admin\LoginController@loginAction')->name('admin.authentication');

Route::group(['middleware' => ['admin']], function() {
    Route::as('admin.')->prefix('admin')->group( function() {
    Route::get('dashboard','Admin\DashboardController@dashboardAction')->name('dashboard');
    Route::get('profile','Admin\DashboardController@editProfile')->name('edit.profile');

    Route::post('profile/update','Admin\DashboardController@updateProfile')->name('update.profile');

    Route::get('edit/password','Admin\DashboardController@editPassword')->name('edit.password');
    Route::post('update/password','Admin\DashboardController@updateProfilePassword')->name('update.password');

    Route::get('logout','Admin\DashboardController@logout')->name('logout');


    Route::as('users.')->prefix('users')->group(function() {

        Route::get('list','Admin\UserController@listUsers')->name('list');
    });

    Route::get('feedback','Admin\DashboardController@feedbackList')->name('feedback');
    Route::post('update-settings','Admin\UnitSettingController@updateSettings')->name('updateSettings');

    });
});

// Route::get('/admin/dashboard', function () {

//     return view('admin.dashboard');
// });