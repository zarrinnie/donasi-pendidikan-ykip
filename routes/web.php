<?php

use Illuminate\Support\Facades\Route;
use App\DTOs\StoreGuestDonationDTO;
use App\Actions\ProcessGuestDonationAction;
use App\Actions\GenerateQrisCodeAction;
use Illuminate\Http\Request;
use App\Models\Donation;

// Admin Routes (Protected by Breeze auth middleware)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::patch('/donations/{donation}/toggle-welcome-email', [\App\Http\Controllers\Admin\DashboardController::class, 'toggleWelcomeEmail'])->name('donations.toggle-welcome-email');
    
    // CRUD Resources
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('donors', \App\Http\Controllers\Admin\DonorController::class);
    Route::resource('donations', \App\Http\Controllers\Admin\DonationController::class);
    Route::resource('packages', \App\Http\Controllers\Admin\DonationPackageController::class);
});

// Guest Frontend Routes
Route::get('/', [\App\Http\Controllers\Frontend\LandingController::class, 'index'])->name('landing');

Route::prefix('donation')->name('donation.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Frontend\DonationFlowController::class, 'create'])->name('form');
    Route::post('/', [\App\Http\Controllers\Frontend\DonationFlowController::class, 'store'])->name('store');
    Route::get('/payment/{donation}', [\App\Http\Controllers\Frontend\DonationFlowController::class, 'payment'])->name('payment');
    Route::get('/receipt/{donation}', [\App\Http\Controllers\Frontend\DonationFlowController::class, 'receipt'])->name('receipt');
});

require __DIR__.'/auth.php';
