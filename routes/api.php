<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\BookController;

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

Route::get("/animal",[AnimalController::class, "index"])->middleware('auth:sanctum');

Route::get('/login',function(){
    return response()->json([
        "status" => "error",
        "message" => "Unauthorized"
    ]);
})->name('login');

Route::group(['prefix'=>'v1'], function(){

    Route::post('/register',[AuthController::class,'register'] );
    Route::post('/login',[AuthController::class,'login']);
    Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');

    Route::get('/books',[BookController::class,'index']);
    Route::get('/books/{id}',[BookController::class,'show']);
    Route::post('/books',[BookController::class, 'store'])->middleware('auth:sanctum');
    Route::put('/books/{id}',[BookController::class, 'update_all'])->middleware('auth:sanctum');
    Route::patch('/books/{id}',[BookController::class, 'update_all'])->middleware('auth:sanctum');

});

