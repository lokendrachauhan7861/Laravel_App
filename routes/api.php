<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/createUser', [App\Http\Controllers\API\UserController::class, 'createUser'])->name('createUser');
Route::post('/login', [App\Http\Controllers\API\UserController::class, 'login'])->name('login');

Route::group(['middleware'=>['UserVerify']], function() {
Route::post('/employee', [App\Http\Controllers\API\EmployeeController::class, 'employee'])->name('employee');
Route::post('/addEmployee', [App\Http\Controllers\API\EmployeeController::class, 'addEmployee'])->name('addEmployee');
Route::delete('/deleteEmployee/{id}', [App\Http\Controllers\API\EmployeeController::class, 'deleteEmployee'])->name('deleteEmployee');
Route::patch('/updateEmployee/{id}', [App\Http\Controllers\API\EmployeeController::class, 'updateEmployee'])->name('updateEmployee');
Route::get('/getEmployee/{id}', [App\Http\Controllers\API\EmployeeController::class, 'getEmployee'])->name('getEmployee');
Route::get('/getCountry', [App\Http\Controllers\API\CountryController::class, 'getCountry'])->name('getCountry');
Route::post('/getState', [App\Http\Controllers\API\StateController::class, 'getState'])->name('getState');
Route::post('/getCity', [App\Http\Controllers\API\CityController::class, 'getCity'])->name('getCity');
});




