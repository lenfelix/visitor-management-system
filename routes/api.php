<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\VisitationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function(){
    return 'abc';
}); 

Route::post('/login', [AuthController::Class, 'login']); 
Route::post('/check-in', [CheckController::Class, 'checkIn']); 
Route::post('/check-out', [CheckController::Class, 'checkOut']); 
Route::get('/visitation', [VisitationController::Class, 'index']); 
