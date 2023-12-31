<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManufacturersController;
use App\Http\Controllers\CarsController;

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

Route::resource('manufacturer', ManufacturersController::class);
Route::get('manufacturer/{id}/cars', [ManufacturersController::class, 'getCarsByManufacturer']);
Route::resource('car', CarsController::class);