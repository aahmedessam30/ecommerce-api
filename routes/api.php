<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProdcutController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\WishlistController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\Auth\VerifyEmailController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function () {

    Route::post('register', [AuthController::class, 'register'])->name('register');

    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('email/verify/{id}/{hash}', [VerifyEmailController::class, 'verify'])
        ->middleware(['signed', 'throttle:6,1'])->name('verification.verify');

    Route::post('email/verify/resend', [VerifyEmailController::class, 'resend'])
        ->middleware(['throttle:6,1'])->name('verification.send');

    Route::post('forgot-password', [ForgotPasswordController::class, 'forget_password'])
        ->middleware('guest');

    Route::post('reset-password', [ForgotPasswordController::class, 'reset_password'])
        ->middleware('guest')
        ->name('reset');
});

Route::apiResource('category', CategoryController::class);

Route::get('category/sub-category/{category}', [CategoryController::class, 'subCategory'])->name('category.sub-category');

Route::apiResource('sub-category', SubCategoryController::class);

Route::get('sub-category/prodcut/{subCategory}', [SubCategoryController::class, 'prodcut'])->name('sub-category.prodcut');

Route::apiResource('prodcut', ProdcutController::class);

Route::apiResource('wishlist', WishlistController::class)->except(['show', 'update']);

Route::post('wishlist/clear', [WishlistController::class, 'clear'])->name('wishlist.clear');
