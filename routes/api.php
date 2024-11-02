<?php

use App\Http\Controllers\Auth\AuthenticatedApiController;
use App\Http\Controllers\SpyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('guest')->group(function () {
    Route::post('login',[AuthenticatedApiController::class,'store'])->name('login');
});

Route::resource('spies', SpyController::class)->only(['index', 'create']);

Route::middleware('guest')->get('spies/random',[SpyController::class,'random'])->middleware('throttle:10,1');
