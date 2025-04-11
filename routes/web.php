<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/setting', [SettingController::class, 'edit'])->name('setting.edit');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('feeds', FeedController::class);
    Route::get('/feeds', [FeedController::class, 'index'])->name('feeds.index');
    Route::get('/feeds/create', [FeedController::class, 'create'])->name('feeds.create');
    Route::post('/feeds', [FeedController::class, 'store'])->name('feeds.store');
    Route::get('/p/{feed_id}', [FeedController::class, 'detailFeed'])->name('feeds.detail');
});

require __DIR__.'/auth.php';
