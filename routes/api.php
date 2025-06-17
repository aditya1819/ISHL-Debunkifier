<?php

use App\Http\Controllers\Api\QuestionApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/questions', [QuestionApiController::class, 'store']);