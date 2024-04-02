<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['middleware' => 'auth'],function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/update/order', [App\Http\Controllers\HomeController::class, 'updateOrder'])->name('updateOrder');

    Route::resource('question', App\Http\Controllers\QuestionController::class)->except('index','show');
});
