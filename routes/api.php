<?php

use App\Http\Controllers\Auth\AuthenticatedApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('guest')->group(function () {
    Route::post('login',[AuthenticatedApiController::class,'store'])->name('login');
});
