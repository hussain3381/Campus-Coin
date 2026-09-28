<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SavingTipController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/dashboard', [TransactionController::class, 'dashboard'])
    ->middleware('auth')
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('transactions', TransactionController::class)->except(['show']);
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('budgets', BudgetController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::get('/saving-tips', [SavingTipController::class, 'index'])
    ->name('saving-tips.index');
    Route::post('/saving-tips/{tip}/pin', [SavingTipController::class, 'togglePin'])->name('saving-tips.pin');
    Route::post('/saving-tips/{tip}/dismiss', [SavingTipController::class, 'dismiss'])->name('saving-tips.dismiss');
});

require __DIR__.'/auth.php';

