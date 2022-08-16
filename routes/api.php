<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\AuthController;

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

Route::post(
    '/authenticate',
    [CompanyController::class, 'auth']
);

Route::post('login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::middleware(['user_authenticate_and_valid'])->group(function () {



    Route::post(
        '/company/new',
        [CompanyController::class, 'create']
    );

    Route::post(
        '/company/update/{id}',
        [CompanyController::class, 'update']
    );

    Route::post(
        '/company/delete/{id}',
        [CompanyController::class, 'destroy']
    );

    Route::post(
        '/employe/invite',
        [EmployeController::class, 'inviteEmploye']
    );

    Route::post(
        '/employe/completeprofile/{id}',
        [EmployeController::class, 'completeEmployeeProfile']
    );

    // Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //     return $request->user();
});
