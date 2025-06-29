<?php

use App\Http\Controllers\Api\QuestionApiController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ExerciseQuestionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/tutorial', [TutorialController::class, 'index'])->name('tutorial.index');
    Route::get('/tutorial/question/{question}', [QuestionController::class, 'show'])->name('tutorial.question');
    Route::post('/tutorial/question/{question}/submit', [QuestionController::class, 'submit'])->name('tutorial.question.submit');
    
    // Placeholder routes for future development
    Route::get('/exercise', [ExerciseController::class,'index'])->name('exercise.index');
    Route::get('/exercise/question/{question}', [ExerciseQuestionController::class,'show'])->name('exercise.question');

    
    Route::post('/exercise/question/{question}/submit', [QuestionApiController::class, 'submit'])
        ->middleware(['auth'])
        ->name('exercise.question.submit');

    Route::get('/exercise/{question}/expert-solution', [ExerciseController::class, 'expertSolution'])->name('exercise.expert-solution');
    
    Route::get('/forum', function () {
        return view('coming-soon', ['title' => 'Forum', 'pageDescription' => 'Community Forum']);
    })->name('forum');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';