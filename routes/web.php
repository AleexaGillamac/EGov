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

//Offices Routes
Route::get('/offices', [OfficesController::class, 'index'])->name('offices.index');
Route::get('/offices/create', [OfficesController::class, 'create'])->name('offices.create');
Route::get('/offices/{id}', [OfficesController::class, 'show'])->name('offices.show');
Route::post('/offices', [OfficesController::class, 'store'])->name('offices.store');
Route::get('/offices/{id}/edit', [OfficesController::class, 'edit'])->name('offices.edit');
Route::put('/offices/{id}', [OfficesController::class, 'update'])->name('offices.update');
Route::delete('/offices/{id}', [OfficesController::class, 'destroy'])->name('offices.destroy');

// Route::get('/dd', function() {
//     $offices = Offices::latest()->get();
//     dd($offices);
// });

//Employees Routes
// Route::get('/employees', [EmployeesController::class, 'index'])->name('employees.index');
// Route::get('employees/create', [EmployeesController::class, 'create'])->name('employees.create');
// Route::get('employees/{id}', [EmployeesController::class, 'show'])->name('employees.show');
// Route::post('employees', [EmployeesController::class, 'store'])->name('employees.store');
// Route::get('employees/{id}/edit', [EmployeesController::class, 'edit'])->name('employees.edit');
// Route::put('employees/{id}', [EmployeesController::class, 'update'])->name('employees.update');
// Route::delete('employees/{id}', [EmployeesController::class, 'destroy'])->name('employees.destroy');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
