<?php

use App\Http\Controllers\ActionController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('index');
Route::Post('/', [ActionController::class, 'action'])->name('action');

Route::fallback(function () {
    return view('fallback');
});
