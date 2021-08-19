<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AchievementsController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CommentController;

Route::get('/users/{user}/achievements', [AchievementsController::class, 'index']);
Route::post('/users/lessons/{lesson}/watch', [LessonController::class, 'watch']);
Route::post('/users/comment/write', [CommentController::class, 'write']);

