<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedController;

// Route::middleware(['auth'])->group(function () {
//     Route::get('/feeds', [FeedController::class, 'index'])->name('feeds.index');
//     Route::get('/feeds/create', [FeedController::class, 'create'])->name('feeds.create');
//     Route::post('/feeds', [FeedController::class, 'store'])->name('feeds.store');
// });

Route::get('/feeds', [FeedController::class, 'index'])->name('feeds.index');

Route::get('/', function () {
    return view('welcome');
});
