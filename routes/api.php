<?php

use App\Http\Controllers\SearchCountyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('municipalities')->group(function () {
    Route::get('/{state}', [SearchCountyController::class, 'searchMunicipalities'])->name('get-municipalities');
});
