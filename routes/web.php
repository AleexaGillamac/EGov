<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\EmployeeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

// Dashboard (Role-based rendering)
Route::get('/dashboard', function () {
    $user = auth()->user();

    return match ($user->role) {
        'superadmin', 'admin', 'director' => Inertia::render('dashboard/AdminDashboard'),
        'employee' => Inertia::render('dashboard/EmployeeDashboard'),
        default => Inertia::render('dashboard/CitizenDashboard'),
    };
})->middleware(['auth'])->name('dashboard');


// OFFICES MODULE
Route::prefix('offices')
    ->controller(OfficeController::class)
    ->middleware(['auth'])
    ->group(function () {

        // Accessible to SuperAdmin + Admin
        Route::middleware(['role:superadmin|admin'])
        ->group(function () {
            Route::get('/create', 'create')->name('offices.officesCreate');
            Route::post('/', 'store')->name('offices.officesStore');
            Route::get('/{office}/edit', 'edit')->name('offices.officesEdit');
            Route::put('/{office}', 'update')->name('offices.officesUpdate');
        });

        // Delete - SuperAdmin only
        Route::delete('/{office}', 'destroy')
            ->middleware(['role:superadmin'])
            ->name('offices.officesDestroy');

        // View - Accessible to all roles
        Route::middleware(['role:superadmin|admin|director|employee|user'])->group(function () {
            Route::get('/', 'index')->name('offices.officesIndex');
            Route::get('/{office}', 'show')->name('offices.officesShow');
        });
    });


// COMPLAINTS MODULE
Route::prefix('complaints')
    ->controller(ComplaintController::class)
    ->middleware(['auth'])
    ->group(function () {

        // 👤 Citizen routes
        Route::middleware(['role:user'])->group(function () {
            Route::get('/', 'index')->name('complaints.complaintsIndex');
            Route::get('/create', 'create')->name('complaints.complaintsCreate');
            Route::post('/', 'store')->name('complaints.complaintsStore');
        });

    });


// FEEDBACKS MODULE
Route::prefix('feedbacks')
    ->controller(FeedbackController::class)
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', 'index')->name('feedbacks.feedabacksIndex');
        Route::get('/create/{complaint}', 'create')->name('feedbacks.feedbacksCreate');
        Route::post('/{complaint}', 'store')->name('feedbacks.feedbacksStore');
        Route::get('/{feedback}', 'show')->name('feedbacks.feedbacksShow');
        Route::delete('/{feedback}', 'destroy')->name('feedbacks.feedbacksDestroy');
    });




Route::middleware(['auth', 'role:superadmin|admin|director'])->group(function () {
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');

    Route::get('/employees/{employee}/permissions', [EmployeeController::class, 'editPermissions'])
        ->name('employees.permissions.edit');
    Route::post('/employees/{employee}/permissions', [EmployeeController::class, 'updatePermissions'])
        ->name('employees.permissions.update');

    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
});


require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
