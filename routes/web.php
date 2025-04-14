<?php

use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\CommentController;
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
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::patch('/setting', [SettingController::class, 'update'])->name('setting.update');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('feeds', FeedController::class);
    Route::get('/feeds', [FeedController::class, 'index'])->name('feeds.index');
    Route::post('/feeds/create', [FeedController::class, 'create'])->name('feeds.create');
    Route::post('/feeds/store', [FeedController::class, 'store'])->name('feeds.store');
    Route::post('/feeds', [FeedController::class, 'store'])->name('feeds.store');
    Route::get('/p/{feed}', [FeedController::class, 'detail']);
    Route::post('/feeds/{feed}/archive', [FeedController::class, 'archive'])->name('feeds.archive');
    Route::post('/feeds/{feed}/unarchive', [FeedController::class, 'unarchive'])->name('feeds.unarchive');
    Route::get('/archive', [ArchiveController::class, 'index'])->name('archive.index');
    Route::get('/archive/export/xlsx', [ArchiveController::class, 'exportXLSX'])->name('archive.export.xlsx');
    Route::get('/archive/export/pdf', [ArchiveController::class, 'exportPDF'])->name('archive.export.pdf');
    Route::post('/comments', [CommentController::class, 'store']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);

});

require __DIR__ . '/auth.php';
