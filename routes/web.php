<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminReservationController;

// Public Routes (General Access)
Route::prefix('/')->group(function () {
    Route::get('/', function () { return view('welcome'); });
    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('home', [ReservationController::class, 'index'])->name('home');
    Route::post('reservasi', [ReservationController::class, 'storeReservation'])->name('store.reservation');
    Route::get('status/{id}', [ReservationController::class, 'showStatus'])->name('status.show');
});

// Payment Routes
Route::prefix('payment')->group(function () {
    Route::get('/', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
    Route::post('/', [PaymentController::class, 'storePayment'])->name('payment.store');
});

// Admin Routes (Admin Access Only)
Route::prefix('admin')->middleware('auth', 'isAdmin')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

// Admin Routes
Route::middleware('auth', 'isAdmin')->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/reservations', [AdminReservationController::class, 'index'])->name('admin.reservations');
    Route::post('/admin/reservations/update/{id}', [AdminReservationController::class, 'update'])->name('admin.reservations.update');
});

// Rute tambahan untuk halaman reservasi
Route::get('reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('reservations/store', [ReservationController::class, 'store'])->name('reservations.store');

