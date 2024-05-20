<?php

use App\Interfaces\Http\Controllers\AuthController;
use App\Interfaces\Http\Controllers\BookController;
use App\Interfaces\Http\Controllers\StoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::prefix('books')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/', [BookController::class, 'index'])->name('book.index');
        Route::get('/{id}', [BookController::class, 'show'])->name('book.show');
        Route::post('/store', [BookController::class, 'store'])->name('book.store');
        Route::put('/{id}', [BookController::class, 'update'])->name('book.update');
        Route::delete('/{id}', [BookController::class, 'destroy'])->name('book.delete');
        Route::post('/{id}/attach-stores', [BookController::class, 'book.attachStores']);
        Route::post('/{id}/detach-stores', [BookController::class, 'book.detachStores']);
        Route::post('/{id}/sync-stores', [BookController::class, 'book.syncStores']);
    });
});

Route::prefix('stores')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/', [StoreController::class, 'index'])->name('store.index');
        Route::get('/{id}', [StoreController::class, 'show'])->name('store.show');
        Route::post('/store', [StoreController::class, 'store'])->name('store.store');
        Route::put('/{id}', [StoreController::class, 'update'])->name('store.update');
        Route::delete('/{id}', [StoreController::class, 'destroy'])->name('store.delete');
    });
});
