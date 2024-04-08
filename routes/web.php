<?php

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GrapeJSController;
use App\Http\Controllers\PixabayController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\RazorpayPaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::controller(RazorpayPaymentController::class)->group(function () {
    Route::get('razorpay-payment',  'index');
    Route::post('razorpay-payment', 'store')->name('razorpay.payment.store');
});

Route::controller(StripePaymentController::class)->group(function () {
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});

Route::controller(PixabayController::class)->group(function () {
    Route::get('/', 'image');
    Route::get('/pixabay-video', 'video')->name('video');
    Route::get('/search-images', 'searchImages');
    Route::get('/search-videos','searchVideos');
});

Route::controller(GoogleLoginController::class)->group(function () {
    Route::get('/auth/google/redirect', 'redirectToGoogle')->name('google.redirect');
    Route::get('auth/google/callback', 'handleGoogleCallback')->name('google.callback');
});

