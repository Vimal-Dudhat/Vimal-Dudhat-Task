<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Api\CompanyController;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Employee's Route
Route::prefix('employee')->group(function () {

    Route::get('/list', [EmployeeController::class, 'index'])->name('employee.list');
    Route::get('/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/store', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::post('/update', [EmployeeController::class, 'update'])->name('employee.update');
    Route::post('/delete', [EmployeeController::class, 'destroy'])->name('employee.delete');

});

Route::get('company/list', function(){
    return view('company');
})->name('company.list');
