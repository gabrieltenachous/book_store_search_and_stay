<?php

use App\Http\Controllers\BookStoreController;
use App\Http\Controllers\UserController;
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
// AUTHENTICATED ROUTES
Route::middleware('auth:sanctum')->group(function () {
    //CRUD BOOK STORE
    Route::apiResource('/book_store', BookStoreController::class);
    //CRUD CATEGORY
    Route::apiResource('/category', BookStoreController::class);
    //LOGOUT OF ACCOUNT
    Route::get('/user/logout', [UserController::class,'logout']);
});

//LOGIN IN ACCOUNT
Route::post('/user/login', [UserController::class,'login']);
//USER REGISTER
Route::post('/user/register', [UserController::class,'register']);