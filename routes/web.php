<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\OffenseLevelController;
use App\Http\Controllers\PenaltyActionController;
use App\Http\Controllers\PenaltyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TransactionViolationController;
use App\Http\Controllers\ViolationCategoryController;
use App\Http\Controllers\ViolationController;
use App\Http\Controllers\YearLevelController;
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
    // student
    Route::prefix('student')->group(function() {
        Route::get('/',[StudentController::class, 'index'])->name('student.index');
        Route::post('/store', [StudentController::class, 'store'])->name('student.store');
        Route::patch('/update/{student}', [StudentController::class, 'update'])->name('student.update');
        Route::delete('/destroy/{student}', [StudentController::class, 'destroy'])->name('student.destroy');
    });

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

    // semester
    Route::prefix('semester')->group(function() {
        Route::get('/',[SemesterController::class, 'index'])->name('semester.index');
        Route::post('/store', [SemesterController::class, 'store'])->name('semester.store');
        Route::patch('/update/{semester}', [SemesterController::class, 'update'])->name('semester.update');
        Route::delete('/destroy/{semester}', [SemesterController::class, 'destroy'])->name('semester.destroy');
    });

    // academic year
    Route::prefix('academic_year')->group(function() {
        Route::get('/',[AcademicYearController::class, 'index'])->name('academic_year.index');
        Route::post('/store', [AcademicYearController::class, 'store'])->name('academic_year.store');
        Route::patch('/update/{academic_year}', [AcademicYearController::class, 'update'])->name('academic_year.update');
        Route::delete('/destroy/{academic_year}', [AcademicYearController::class, 'destroy'])->name('academic_year.destroy');
    });

    // year level
    Route::prefix('year_level')->group(function() {
        Route::get('/',[YearLevelController::class, 'index'])->name('year_level.index');
        Route::post('/store', [YearLevelController::class, 'store'])->name('year_level.store');
        Route::patch('/update/{year_level}', [YearLevelController::class, 'update'])->name('year_level.update');
        Route::delete('/destroy/{year_level}', [YearLevelController::class, 'destroy'])->name('year_level.destroy');
    });

    // section
    Route::prefix('section')->group(function() {
        Route::get('/',[SectionController::class, 'index'])->name('section.index');
        Route::post('/store', [SectionController::class, 'store'])->name('section.store');
        Route::patch('/update/{section}', [SectionController::class, 'update'])->name('section.update');
        Route::delete('/destroy/{section}', [SectionController::class, 'destroy'])->name('section.destroy');
    });

    // transaction violation
    Route::prefix('transaction_violation')->group(function() {
        Route::get('/',[TransactionViolationController::class, 'index'])->name('transaction_violation.index');
        Route::get('/create',[TransactionViolationController::class, 'create'])->name('transaction_violation.create');
        Route::post('/store', [TransactionViolationController::class, 'store'])->name('transaction_violation.store');
        Route::get('/show/{transaction_violation}',[TransactionViolationController::class, 'show'])->name('transaction_violation.show');
        Route::get('/edit/{transaction_violation}',[TransactionViolationController::class, 'edit'])->name('transaction_violation.edit');
        Route::patch('/resolve/{transaction_violation}',[TransactionViolationController::class, 'resolve'])->name('transaction_violation.resolve');
        Route::patch('/update/{transaction_violation}', [TransactionViolationController::class, 'update'])->name('transaction_violation.update');
        Route::delete('/destroy/{transaction_violation}', [TransactionViolationController::class, 'destroy'])->name('transaction_violation.destroy');
    });

});

require __DIR__.'/auth.php';
