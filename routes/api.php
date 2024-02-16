<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\CallbackController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UploadController;
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

Route::post('/login',[AuthController::class, 'login']);
Route::post('/register',[AuthController::class, 'register']);
Route::post('/image/upload',[UploadController::class, 'uploadImage']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum'); // Route logout
Route::post('/orders', [OrderController::class, 'order'])->middleware('auth:sanctum');

Route::post('midtrans/notification/handling',[CallbackController::class, 'callback']);


Route::apiResource('categories', CategoryController::class);
Route::apiResource('product', ProductController::class);
Route::apiResource('banners',BannerController::class);


