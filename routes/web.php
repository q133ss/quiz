<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/update/order', [App\Http\Controllers\HomeController::class, 'updateOrder'])->name('updateOrder');

Route::resource('question', App\Http\Controllers\QuestionController::class)->except('index','show');
