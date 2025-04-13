<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\BookController;
use App\Http\Controllers\api\v1\BorrowingController;

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

    Route::get('/borrowings',[BorrowingController::class, 'index']);


    Route::middleware('auth:sanctum')->group(function(){
        Route::post('/books',[BookController::class, 'store']);
        Route::put('/books/{id}',[BookController::class, 'update_all']);
        Route::patch('/books/{id}',[BookController::class, 'update_partial']);
        Route::delete('/books/{id}', [BookController::class, 'delete']);

        Route::post('/borrow',[BorrowingController::class,'borrow']);
        Route::post('/return', [BorrowingController::class, 'return_book']);


    });

});

