<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Get all Todos
Route::get('/categories', [CategoryController::class, 'index']);

// Get all Todos
Route::post('/category', [CategoryController::class, 'store']);

// Get Category
Route::get('/category/{category}', [CategoryController::class, 'show']);

// Update CAtegory
Route::put('/category/{category}', [CategoryController::class, 'update']);

// Delete Category
Route::delete('/category/{category}', [CategoryController::class, 'destroy']);
