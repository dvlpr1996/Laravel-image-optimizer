<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActionController;

Route::view('/', 'index')->name('index');
Route::Post('/', [ActionController::class, 'action'])->name('action');

Route::fallback(function () {
    return view('fallback');
});
