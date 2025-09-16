<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\FleetController;
use App\Http\Controllers\LocationCheckInController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ShipmentController;
use Illuminate\Support\Facades\Route;

// Pelacakan Pengiriman
Route::get('/', [ShipmentController::class, 'index'])->name('home');
Route::get('/track', [ShipmentController::class, 'track'])->name('track');
Route::post('/track', [ShipmentController::class, 'showTracking'])->name('track.show');

// Manajemen Armada
Route::resource('fleets', FleetController::class);

// Pemesanan Armada
Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

// Check-in Lokasi
Route::get('/checkin/{fleet}', [LocationCheckInController::class, 'create'])->name('checkin.create');
Route::post('/checkin', [LocationCheckInController::class, 'store'])->name('checkin.store');
Route::get('/fleet-map', [LocationCheckInController::class, 'map'])->name('fleet.map');

// Laporan
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
