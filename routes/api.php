<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CommentController;


Route::post('/login', [AuthController::class, 'userLogin']);

// Tidak harus login
Route::controller(NewsController::class)->group(function () {
    // Route News tidak harus login
    Route::get('/news', 'index');
    Route::get('/news/{id}/detail', 'show');
});

// Harus login terlebih dahulu
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/logout', [AuthController::class, 'userLogout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Route untuk news Harus Login
    Route::post('/news', [NewsController::class, 'store']);
    // Hanya Owner yang bisa edit dan delete
    Route::patch('/news/{id}/update', [NewsController::class, 'update'])->middleware('news-owner');
    Route::delete('/news/{id}/delete', [NewsController::class, 'destroy'])->middleware('news-owner');

    // Rote Comment
    Route::post('/news/{news_id}/comment', [CommentController::class, 'store']);
    Route::patch('/news/comment/{id}', [CommentController::class, 'update'])->middleware('comment-owner');
    Route::delete('/news/comment/{id}/delete', [CommentController::class, 'destroy'])->middleware('comment-owner');
});
