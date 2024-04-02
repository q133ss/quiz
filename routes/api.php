<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/questions', [\App\Http\Controllers\API\QuestionController::class, 'index']);
Route::get('/next/question/{answer_id}', [\App\Http\Controllers\API\QuestionController::class, 'next']);
Route::post('/create/request', [\App\Http\Controllers\API\QuestionController::class, 'request']);
