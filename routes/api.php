<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\RecordChatController;
use App\Http\Controllers\Api\ReturnOrderController;

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

Route::post('/record-chat', [RecordChatController::class, 'store'])->name('api.record-chat.store');

// Product Routes
// Di ProductController, hanya method index() dan show() yang aktif.
Route::apiResource('products', ProductController::class)->only(['index', 'show']);

// Order Routes
Route::post('/orders', [OrderController::class, 'store'])->name('api.orders.store');

// Return Order Routes
Route::post('/returns', [ReturnOrderController::class, 'store'])->name('api.returns.store');
Route::get('/returns/{return_code}', [ReturnOrderController::class, 'showByReturnCode'])->name('api.returns.show');
