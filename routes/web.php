<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['middleware' => 'auth'],function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/update/order', [App\Http\Controllers\HomeController::class, 'updateOrder'])->name('updateOrder');
    Route::get('/requests', [App\Http\Controllers\HomeController::class, 'requests'])->name('requests');
    Route::get('/requests/{id}', [App\Http\Controllers\HomeController::class, 'requestShow'])->name('requests.show');

    Route::resource('question', App\Http\Controllers\QuestionController::class)->except('index','show');
});
