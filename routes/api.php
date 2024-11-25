<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\Logging\EventLogger;

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

// Get all Locations
Route::get('/locations', [LocationController::class, 'index']);

// Create new Location
Route::post('/location', [LocationController::class, 'store']);

// Get Location
Route::get('/location/{location}', [LocationController::class, 'show']);

// Update Location
Route::put('/location/{location}', [LocationController::class, 'update']);

// Delete Location
Route::delete('/location/{location}', [LocationController::class, 'destroy']);

// Get all Events
Route::get('/events', [EventController::class, 'index']);
