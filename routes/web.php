<?php

use App\Http\Controllers\CollegeController;
use App\Http\Controllers\OffenseLevelController;
use App\Http\Controllers\PenaltyActionController;
use App\Http\Controllers\PenaltyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ViolationCategoryController;
use App\Http\Controllers\ViolationController;
use App\Models\OffenseLevel;
use App\Models\ViolationCategory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canResetPassword' => Route::has('password.request'),
        'status' => session('status'),
    ]);

    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// SETTINGS
    // college
    Route::prefix('college')->group(function() {
        Route::get('/',[CollegeController::class, 'index'])->name('college.index');
        Route::post('/store', [CollegeController::class, 'store'])->name('college.store');
        Route::patch('/update/{college}', [CollegeController::class, 'update'])->name('college.update');
        Route::delete('/destroy/{college}', [CollegeController::class, 'destroy'])->name('college.destroy');
    });

    // status
    Route::prefix('status')->group(function() {
        Route::get('/',[StatusController::class, 'index'])->name('status.index');
        Route::post('/store', [StatusController::class, 'store'])->name('status.store');
        Route::patch('/update/{status}', [StatusController::class, 'update'])->name('status.update');
        Route::delete('/destroy/{status}', [StatusController::class, 'destroy'])->name('status.destroy');
    });

    // program
    Route::prefix('program')->group(function() {
        Route::get('/',[ProgramController::class, 'index'])->name('program.index');
        Route::post('/store', [ProgramController::class, 'store'])->name('program.store');
        Route::patch('/update/{program}', [ProgramController::class, 'update'])->name('program.update');
        Route::delete('/destroy/{program}', [ProgramController::class, 'destroy'])->name('program.destroy');
    });

    // violation
    Route::prefix('violation')->group(function() {
        Route::get('/',[ViolationController::class, 'index'])->name('violation.index');
        Route::post('/store', [ViolationController::class, 'store'])->name('violation.store');
        Route::patch('/update/{violation}', [ViolationController::class, 'update'])->name('violation.update');
        Route::delete('/destroy/{violation}', [ViolationController::class, 'destroy'])->name('violation.destroy');
    });

    // violation category
    Route::prefix('violation_category')->group(function() {
        Route::get('/',[ViolationCategoryController::class, 'index'])->name('violation_category.index');
        Route::post('/store', [ViolationCategoryController::class, 'store'])->name('violation_category.store');
        Route::patch('/update/{violation_category}', [ViolationCategoryController::class, 'update'])->name('violation_category.update');
        Route::delete('/destroy/{violation_category}', [ViolationCategoryController::class, 'destroy'])->name('violation_category.destroy');
    });

    // penalty
    Route::prefix('penalty')->group(function() {
        Route::get('/',[PenaltyController::class, 'index'])->name('penalty.index');
        Route::post('/store', [PenaltyController::class, 'store'])->name('penalty.store');
        Route::patch('/update/{penalty}', [PenaltyController::class, 'update'])->name('penalty.update');
        Route::delete('/destroy/{penalty}', [PenaltyController::class, 'destroy'])->name('penalty.destroy');
    });

    // offense level
    Route::prefix('offense_level')->group(function() {
        Route::get('/',[OffenseLevelController::class, 'index'])->name('offense_level.index');
        Route::post('/store', [OffenseLevelController::class, 'store'])->name('offense_level.store');
        Route::patch('/update/{offense_level}', [OffenseLevelController::class, 'update'])->name('offense_level.update');
        Route::delete('/destroy/{offense_level}', [OffenseLevelController::class, 'destroy'])->name('offense_level.destroy');
    });

    // penalty action
    Route::prefix('penalty_action')->group(function() {
        Route::get('/',[PenaltyActionController::class, 'index'])->name('penalty_action.index');
        Route::post('/store', [PenaltyActionController::class, 'store'])->name('penalty_action.store');
        Route::patch('/update/{penalty_action}', [PenaltyActionController::class, 'update'])->name('penalty_action.update');
        Route::delete('/destroy/{penalty_action}', [PenaltyActionController::class, 'destroy'])->name('penalty_action.destroy');
    });
});

require __DIR__.'/auth.php';
