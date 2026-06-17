<?php

use App\Enums\UserRole;
use App\Http\Controllers\AgencySettingController;
use App\Http\Controllers\AuditLeadController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MonthlyReportController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuditLeadController::class, 'create'])->name('audit.create');
Route::post('/audit-request', [AuditLeadController::class, 'store'])->name('audit.store');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::middleware('role:' . UserRole::AGENCY_ADMIN . ',' . UserRole::ACCOUNT_MANAGER)->group(function () {
        Route::resource('clients', ClientController::class)->except(['destroy']);
        Route::get('/clients/{client}/projects/create', [ProjectController::class, 'create'])->name('projects.create');
        Route::post('/clients/{client}/projects', [ProjectController::class, 'store'])->name('projects.store');
        Route::post('/clients/{client}/reports', [MonthlyReportController::class, 'store'])->name('reports.store');
    });

    Route::middleware('role:' . UserRole::AGENCY_ADMIN)->group(function () {
        Route::get('/settings/agency', [AgencySettingController::class, 'edit'])->name('settings.agency.edit');
        Route::patch('/settings/agency', [AgencySettingController::class, 'update'])->name('settings.agency.update');
    });

    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::patch('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::post('/projects/{project}/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::get('/reports/{report}', [MonthlyReportController::class, 'show'])->name('reports.show');
    Route::patch('/reports/{report}', [MonthlyReportController::class, 'update'])->name('reports.update');
});
