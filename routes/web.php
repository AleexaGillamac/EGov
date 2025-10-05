<?php

use App\Http\Controllers\OfficesController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/offices', [OfficesController::class, 'index'])->name('offices.index');
Route::get('/offices/create', [OfficesController::class, 'create'])->name('offices.create');
Route::post('/offices', [OfficesController::class, 'store'])->name('offices.store');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
