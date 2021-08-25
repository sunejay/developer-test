<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AchievementsController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;

Route::get('/users/{user}/achievements', [AchievementsController::class, 'index']);
Route::get('/users/lessons', [LessonController::class, 'list'])->name('lesson.list');
Route::get('/users/lessons/{lesson:id}', [LessonController::class, 'show'])->name('lesson.show');
Route::post('/users/lessons/{lesson:id}/watch', [LessonController::class, 'watch'])->name('watch');
Route::get('/users/comment/write', [CommentController::class, 'write'])->name('comment.write');
Route::post('/users/comment/write', [CommentController::class, 'save']);
Route::get('/lesson/watch', [LessonController::class, 'watching']);
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'signup']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('/users/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

