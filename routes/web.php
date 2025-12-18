<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Frontend Pages
Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/menu', [PageController::class, 'menu'])->name('menu');
Route::get('/booking', [PageController::class, 'booking'])->name('booking');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contacts', [PageController::class, 'contacts'])->name('contacts');

// Booking Form Submission
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

// Reservation Management (Public)
Route::get('/reservation/{code}', [App\Http\Controllers\ReservationManageController::class, 'show'])->name('reservation.manage');
Route::post('/reservation/{code}/update', [App\Http\Controllers\ReservationManageController::class, 'update'])->name('reservation.update');
Route::post('/reservation/{code}/cancel', [App\Http\Controllers\ReservationManageController::class, 'cancel'])->name('reservation.cancel');
