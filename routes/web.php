<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActController;
use App\Http\Controllers\InspectionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/acts/{act}/print', [ActController::class, 'print'])->name('acts.print');
Route::get('/inspections/{inspection}/print', [InspectionController::class, 'print'])->name('inspections.print');

Route::get('/', function () {
    return view('welcome');
});
