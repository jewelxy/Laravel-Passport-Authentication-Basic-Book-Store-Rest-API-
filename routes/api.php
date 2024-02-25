<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\Book\BookController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(UserController::class)->group(function(){
    Route::post('login','loginUser');
});

Route::controller(UserController::class)->group(function(){
    Route::get('user','getUserDetails');
    Route::post('user','storeUser');
    Route::get('user/{id}','showUser');
    Route::put('user/{id}','updateUser');
    Route::delete('user/{id}','destroyUser');
    Route::get('logout','getLogout');
})->middleware('auth:api');

Route::controller(BookController::class)->group(function(){
    Route::get('book','index');
    Route::post('book','store');
    Route::get('book/{id}','show');
    Route::put('book/{id}','update');
    Route::delete('book/{id}','destroy');
})->middleware('auth:api');

