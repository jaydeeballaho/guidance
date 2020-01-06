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
    // return view('welcome');
    return redirect()->route('login');
});


Route::prefix('profile')->middleware('verified')->group(function (){
    Route::middleware('student')->group(function (){
        Route::post('/', 'StudentController@updateStudentProfile')->name('profile.update');
    });

    Route::middleware('adminOrCounselor')->group(function (){
        Route::get('{id}', 'StudentController@getStudentProfile')->name('profile.view');
        Route::post('{id}', 'StudentController@verifyInformation')->name('profile.verify');
    });
});

Route::prefix('account')->middleware('auth')->group(function (){
    Route::get('/', 'AccountController@getAccountDetails')->name('account');
    Route::post('/', 'AccountController@editAccountDetails')->name('account.edit');
    Route::post('/change_password', 'AccountController@changePassword')->name('account.password_change');
});

Route::prefix('maintenance')->middleware(['auth', 'admin'])->group(function(){
    Route::get('/', 'MaintenanceController@indexView')->name('maintenance.view');
    Route::get('colleges', 'MaintenanceController@collegesView')->name('maintenance.colleges');
    Route::get('college/{id}', 'MaintenanceController@coursesView')->name('maintenance.courses');
    Route::get('accounts', 'MaintenanceController@accountsView')->name('maintenance.accounts');

    Route::post('course', 'MaintenanceController@addCourse')->name('maintenance.course.add');
    Route::post('course/update', 'MaintenanceController@updateCourse')->name('maintenance.course.update');
    Route::post('course/delete', 'MaintenanceController@deleteCourse')->name('maintenance.course.delete');

    Route::post('college', 'MaintenanceController@addCollege')->name('maintenance.colleges.add');
    Route::post('college/update', 'MaintenanceController@updateCollege')->name('maintenance.colleges.update');
    Route::post('college/delete', 'MaintenanceController@deleteCollege')->name('maintenance.college.delete');


    Route::post('account', 'MaintenanceController@updateAccount')->name('maintenance.account.update');
    Route::post('account/add', 'MaintenanceController@addAccount')->name('maintenance.account.add');
    Route::post('account/deactivate', 'MaintenanceController@deactivateAccount')->name('maintenance.account.deactivate');
    Route::post('account/reactivate', 'MaintenanceController@reactivateAccount')->name('maintenance.account.reactivate');

    Route::get('logs', 'MaintenanceController@showSystemLogs')->name('maintenance.logs');

    Route::get('config', 'MaintenanceController@getConfigs')->name('maintenance.config');
    Route::post('config', 'MaintenanceController@updateConfig')->name('maintenance.config');

});

Route::post('search', 'StudentController@searchStudent')->middleware('adminOrCounselor')->name('profile.search');

Route::get('search', function (){
    return redirect()->route('dashboard');
});

// Auth::routes();
Auth::routes(['verify' => true]);

Route::get('dashboard', 'HomeController@index')->middleware('verified')->name('dashboard');
