<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->name('register');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');


Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.store');

Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

    Route::middleware('auth:sanctum')->post('/logout', [AuthenticatedSessionController::class, 'logout']);



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

// Create Event
Route::post('/event', [EventController::class, 'store']);

// Get Event
Route::get('/event/{event}', [EventController::class, 'show']);

// Update Event
Route::put('/event/{event}', [EventController::class, 'update']);

// Delete Event
Route::delete('/event/{event}', [EventController::class, 'destroy']);
