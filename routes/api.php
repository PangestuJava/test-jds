<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;


Route::post('/login', [AuthController::class, 'userLogin']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/news', [NewsController::class, 'index']);
    Route::get('/news/{id}/detail', [NewsController::class, 'show']);

    Route::get('/logout', [AuthController::class, 'userLogout']);
    Route::get('/me', [AuthController::class, 'me']);
});
