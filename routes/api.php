<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\ActionController;

Route::prefix('v1')->group(function () {
    Route::GET('/download', [ActionController::class, 'download']);
    Route::Post('/', [ActionController::class, 'action']);
});

Route::fallback(function () {
    return response()->json([
        'status' => 'error',
        'message' => 'uri not found',
    ], 404);
});
