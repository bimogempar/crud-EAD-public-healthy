<?php

use App\Http\Controllers\PatientController;
use App\Http\Controllers\VaccineController;
use Illuminate\Support\Facades\Route;

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

Route::get('/vaccine', [VaccineController::class, 'index']);
Route::post('/vaccine', [VaccineController::class, 'store']);
Route::patch('/vaccine/update/{vaccine:id}', [VaccineController::class, 'update']);
Route::delete('/vaccine/delete/{vaccine:id}', [VaccineController::class, 'destroy']);

Route::get('/patient', [PatientController::class, 'index']);
Route::post('/patient/{vaccine:id}', [PatientController::class, 'store']);
Route::patch('/patient/update/{patient:id}', [PatientController::class, 'update']);
Route::delete('/patient/delete/{patient:id}', [PatientController::class, 'destroy']);
