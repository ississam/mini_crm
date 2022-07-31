<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;

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


Route::middleware(['user_authenticate_and_valid'])->group(function () {

    Route::get(
        '/company',
        [CompanyController::class, 'index']
    )->name('generatePayout');

    Route::post(
        '/company/new   ',
        [CompanyController::class, 'create']
    );
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
});
