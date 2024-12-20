<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::post('/sku-generate', [ProductController::class, 'skuGenerate']);

Route::post('/array1', [ProductController::class, 'array1']);

Route::post('/array2', [ProductController::class, 'array2']);

Route::post('/array3', [ProductController::class, 'array3']);

Route::post('/array4', [ProductController::class, 'array4']);

Route::post('/array5', [ProductController::class, 'array5']);

Route::post('/array6', [ProductController::class, 'array6']);