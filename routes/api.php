<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CompanyController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Company's Route

Route::prefix('company')->group(function () {

    Route::get('/list', [CompanyController::class, 'index']);
    Route::get('/create', [CompanyController::class, 'create']);
    Route::post('/store', [CompanyController::class, 'store']);
    Route::get('/edit', [CompanyController::class, 'edit']);
    Route::post('/update', [CompanyController::class, 'update']);
    Route::post('/delete', [CompanyController::class, 'destroy']);

});