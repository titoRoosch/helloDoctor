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
    return view('home');
})->middleware('auth');


Route::get('/home', function () {
    return view('home');
});


Route::prefix('doctor')->group(function(){
    Route::get('list', function(){
        return view('doctor/list');
    })->middleware('auth');

    Route::get('register', function(){
        return view('doctor/register');
    })->middleware('auth');

    Route::get('edit/{id}', 'DoctorController@viewConfigure')->middleware('auth');

    Route::prefix('api')->group(function(){
        Route::get('list', 'DoctorController@listDoctors');
        Route::post('search', 'DoctorController@getDoctorByName');
        Route::post('register', 'DoctorController@insertDoctor');
        Route::get('details/{id}', 'DoctorController@doctorDetails');
        Route::put('update/{id}', 'DoctorController@updateDoctor');
        Route::put('delete/{id}', 'DoctorController@deleteDoctor');
    });
});



Route::prefix('specialties')->group(function(){
    Route::get('list', function(){
        return view('specialties/list');
    })->middleware('auth');
    Route::get('register', function(){
        return view('specialties/register');
    })->middleware('auth');

    Route::get('edit/{id}', 'SpecialtiesController@viewConfigure')->middleware('auth');

    Route::prefix('api')->group(function(){
        Route::get('list', 'SpecialtiesController@listSpecialties');
        Route::post('search', 'SpecialtiesController@getSpecialtiesByName');
        Route::post('register', 'SpecialtiesController@insertSpecialtie');
    });
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

