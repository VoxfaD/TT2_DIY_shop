<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', [ListingController::class, 'index'])->name('listings.index');
Route::get('/listings/{id}', [ListingController::class, 'show'])->name('listings.show');

// Routes for email authenticated users
Route::middleware(['auth'])->group(function () {
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// Routes for registered users (vendors)
Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::get('/listings/create', [ListingController::class, 'create'])->name('listings.create');
    Route::post('/listings', [ListingController::class, 'store'])->name('listings.store');
    Route::get('/listings/{id}/edit', [ListingController::class, 'edit'])->name('listings.edit');
    Route::put('/listings/{id}', [ListingController::class, 'update'])->name('listings.update');
    Route::delete('/listings/{id}', [ListingController::class, 'destroy'])->name('listings.destroy');
    Route::get('/profile/edit', [SellerController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [SellerController::class, 'update'])->name('profile.update');
});

// Routes for admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('admin.destroyUser');
    Route::delete('/listings/{id}', [AdminController::class, 'destroyListing'])->name('admin.destroyListing');
    Route::delete('/reviews/{id}', [AdminController::class, 'destroyReview'])->name('admin.destroyReview');
});

Route::get('/', [ListingController::class, 'index']);
Route::get('/listing/{id}', [ListingController::class, 'show'])->name('listing.show');
Route::get('/seller/{id}', [UserController::class, 'show'])->name('seller.show');
Route::resource('listings', ListingController::class);
Route::get('seller/{id}', [SellerController::class, 'show'])->name('seller.show');
Route::get('seller/{id}/edit', [SellerController::class, 'edit'])->name('seller.edit');
Route::put('seller/{id}', [SellerController::class, 'update'])->name('seller.update');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';