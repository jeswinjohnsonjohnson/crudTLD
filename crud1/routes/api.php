<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;

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

Route::post('login', [AuthController::class, 'authenticate']);
Route::post('register', [AuthController::class, 'registerAuth']);




Route::namespace('App\\Http\\Controllers')->group(function () {
    Route::apiResources([
        'employee' => 'EmployeeController',
    ]);
});

Route::post('/upload', [EmployeeController::class, 'upload'])->name('upload');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
