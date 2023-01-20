<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActionController;

Route::view('/', 'index');
Route::Post('/', [ActionController::class, 'action'])->name('action');
