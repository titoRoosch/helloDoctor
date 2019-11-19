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
    return $request->user();
});

Route::prefix('doctors')->group(function(){
    Route::get('list', 'DoctorController@listDoctors');
    Route::post('register', 'DoctorController@insertDoctor');
    Route::put('update/{id}', 'DoctorController@updateDoctor');
    Route::delete('delete/{id}', 'DoctorController@deleteDoctor');
    Route::prefix('search')->group(function(){
        Route::post('name', 'DoctorController@getDoctorByName');
        Route::get('crm/{crm}', 'DoctorController@getDoctorByCrm');
    });
    Route::get('details/{id}', 'DoctorController@doctorDetails');
});

Route::prefix('specialties')->group(function(){
    Route::get('list', 'SpecialtiesController@listSpecialties');
    Route::post('register', 'SpecialtiesController@insertSpecialtie');
    Route::put('update/{id}', 'SpecialtiesController@updateSpecialtie');
    Route::delete('delete/{id}', 'SpecialtiesController@deleteSpecialtie');
    Route::get('details/{id}', 'SpecialtiesController@specialtyDetails');
});