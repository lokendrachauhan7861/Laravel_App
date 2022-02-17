<?php

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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('/employee', [App\Http\Controllers\EmployeeController::class, 'employee'])->name('employee')->middleware('UserVerify');
Route::post('/addEmployee', [App\Http\Controllers\EmployeeController::class, 'addEmployee'])->name('addEmployee');
Route::delete('/deleteEmployee/{id}', [App\Http\Controllers\EmployeeController::class, 'deleteEmployee'])->name('deleteEmployee');
Route::patch('/updateEmployee/{id}', [App\Http\Controllers\EmployeeController::class, 'updateEmployee'])->name('updateEmployee');
Route::get('/getEmployee/{id}', [App\Http\Controllers\EmployeeController::class, 'getEmployee'])->name('getEmployee')->middleware('UserVerify');



Route::get('/getCountry', [App\Http\Controllers\CountryController::class, 'getCountry'])->name('getCountry');
Route::post('/getState', [App\Http\Controllers\StateController::class, 'getState'])->name('getState');
Route::post('/getCity', [App\Http\Controllers\CityController::class, 'getCity'])->name('getCity');


Route::post('/login', [App\Http\Controllers\UserController::class, 'login'])->name('login');


Route::post('/createUser', [App\Http\Controllers\UserController::class, 'createUser'])->name('createUser');
