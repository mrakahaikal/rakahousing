<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('panel', 'components.layouts.panel');
Route::view('front', 'components.layouts.app');

Route::name('front.')->group(function () {
    Route::get('/', [FrontController::class, 'index'])->name('index');
    Route::get('/category/{category:slug}', [FrontController::class, 'category'])->name('category');

    Route::get('/details/{house:slug}', [FrontController::class, 'details'])->name('details');
    Route::get('/search', [FrontController::class, 'search'])->name('search');
});

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])
            ->name('index');

        Route::get('/mortgage/{mortgageRequest}', [DashboardController::class, 'details'])
            ->name('details');

        Route::view('profile', 'profile')
            ->name('profile');


        Route::get('/mortgage/installment/{installment}', [DashboardController::class, 'installmentDetails'])
            ->name('installment.details');

        Route::get('/mortgage/{mortgageRequest}/installment/payment', [DashboardController::class, 'installmentPayment'])
          ->name('installment.payment');

        Route::post('/mortgage/installment/payment', [DashboardController::class, 'paymentStoreMidtrans'])
          ->name('installment.paymentStoreMidtrans');

    });

    Route::name('front.')->group(function () {
          Route::get('/request/mortgage/{interest}', [FrontController::class, 'interest'])
              ->name('interest');

          Route::post('/request/mortgage/submitted', [FrontController::class, 'requestInterest'])
              ->name('interest.submitted');

          Route::get('/request/success', [FrontController::class, 'requestSuccess'])
              ->name('requestSuccess');
    });
});

Route::match(['get', 'post'], '/mortgage/interest/payment/midtrans/notification', [DashboardController::class, 'paymentMidtransNotification'])
    ->name('midtrans.notification');

require __DIR__.'/auth.php';
