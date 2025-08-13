<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReturnOrderController;

use App\Http\Controllers\RecordChatController;
use App\Http\Controllers\ProductController;

// Route::get('/', function () {
//     return view('welcome');
// });

/** Login Routes **/
Route::get('/', function () {
    return redirect()->route('login');
});

// Route untuk menampilkan form login (GET)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Route untuk memproses login (POST)
Route::post('/login', [AuthController::class, 'login']);

// Route untuk logout (POST)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/** Group Admin (Hanya admin bisa akses) **/
Route::middleware(['auth', 'check.role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });

    // Manajemen User
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('products', ProductController::class);
    });
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('orders', OrderController::class)->only(['index', 'edit', 'update']);
    });
    Route::get('/admin/orders/report/pdf', [App\Http\Controllers\OrderController::class, 'downloadPdf'])->name('admin.orders.report.pdf');
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('returns', [ReturnOrderController::class, 'index'])->name('returns.index'); // READ ALL
        Route::get('returns/{id}', [ReturnOrderController::class, 'show'])->name('returns.show');
        Route::put('returns/{id}', [ReturnOrderController::class, 'update'])->name('returns.update');
        Route::get('returns/report/pdf', [ReturnOrderController::class, 'downloadPdf'])->name('returns.report.pdf'); // PDF Report
    });
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('record-chats', [RecordChatController::class, 'index'])->name('record-chats.index');
        Route::get('record-chats/report/pdf', [RecordChatController::class, 'downloadPdf'])->name('record-chats.report.pdf');
    });
});

/** Group user (Hanya user bisa akses) **/
Route::middleware(['auth', 'check.role:user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    });
});
