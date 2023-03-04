<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

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

Route::POST('/save-employee',[EmployeeController::class,'store']);
Route::PUT('/update-employee/{id}',[EmployeeController::class,'updateEmployee']);
Route::DELETE('/delete-employee/{id}',[EmployeeController::class,'deleteEmployee']);
Route::GET('/get-employees',[EmployeeController::class,'getAllEmployees']);

