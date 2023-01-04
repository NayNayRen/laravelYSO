<?php

use App\Models\Deal;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DealController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\NavigationPageController;

// MAIN/LANDING PAGE ROUTE
Route::get('/', [DealController::class, 'index'])->name('deals.index');

// SINGLE DEAL SELECTED ROUTE
Route::get('/deals/{deal}', [DealController::class, 'showDeal'])->name('deals.show');

// LOCATION DEALS ROUTE
Route::get('/locations/{location}', [LocationController::class, 'showLocationDeals'])->name('locations.show');

// CATEGORY ROUTES
Route::get('/category_pages/searchResults', [DealController::class, 'searchDeal'])->name('deals.search');
Route::get('/category_pages/featured', [DealController::class, 'allFeatured'])->name('deals.featured');
Route::get('/category_pages/food', [DealController::class, 'allFood'])->name('deals.food');
Route::get('/category_pages/fashion', [DealController::class, 'allFashion'])->name('deals.fashion');
Route::get('/category_pages/auto', [DealController::class, 'allAuto'])->name('deals.auto');
Route::get('/category_pages/fun', [DealController::class, 'allFun'])->name('deals.fun');
Route::get('/category_pages/health', [DealController::class, 'allHealth'])->name('deals.health');
Route::get('/category_pages/tech', [DealController::class, 'allTech'])->name('deals.tech');
Route::get('/category_pages/popular', [DealController::class, 'allPopular'])->name('deals.popular');

// HEADER NAVIGATION ROUTES
Route::get('/navigation_pages/rewards', [NavigationPageController::class, 'rewards'])->name('rewards');
Route::get('/navigation_pages/enhance', [NavigationPageController::class, 'enhance'])->name('enhance');
Route::get('/navigation_pages/support', [NavigationPageController::class, 'support'])->name('support');
Route::get('/navigation_pages/about', [NavigationPageController::class, 'about'])->name('about');

// FAVORITE ROUTES
// add to favorites
Route::post('/favorite', [FavoriteController::class, 'favoriteDeal'])->name('add.favorite');
// add to coupons
Route::post('/coupon', [CouponController::class, 'userCoupons'])->name('add.coupon');

// REGISTER, LOG IN, UPDATE & DELETE ROUTES
// shows register form
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('user.create');
// registers user
Route::post('/user_pages', [UserController::class, 'registerUser'])->name('user.store');
// shows log in form
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login.showLoginForm');
// logs user in
Route::post('/user_pages/authenticate', [UserController::class, 'loginUser'])->name('login');
// show update user info form
Route::get('/user_pages/update', [UserController::class, 'showUpdateForm'])->name('user.showUpdateForm');
// update user info
Route::put('/user_pages/update/{user}', [UserController::class, 'updateUser'])->name('user.update');
// delete user
Route::delete('/user_pages/update/{user}', [UserController::class, 'deleteUser'])->name('user.delete');

// SOCIAL MEDIA LOG IN ROUTES
// methods used when media button is clicked
Route::get('/auth/facebook/redirect', [UserController::class, 'facebookRedirect']);
Route::get('/auth/google/redirect', [UserController::class, 'googleRedirect']);
Route::get('/auth/apple/redirect', [UserController::class, 'appleRedirect']);
// methods used for the look up and return of user data
Route::get('/auth/facebook/callback', [UserController::class, 'facebookCallback']);
Route::get('/auth/google/callback', [UserController::class, 'googleCallback']);
Route::post('/auth/apple/callback', [UserController::class, 'appleCallback']);

// VERIFY USER ROUTES
// show verify form
Route::get('/verify/{id}', [UserController::class, 'showVerifyForm'])->name('login.showVerifyForm');
// send verify code
Route::post('/code', [UserController::class, 'sendVerifyCode'])->name('send.code');
// verify user
Route::post('/verify/code/{id}', [UserController::class, 'verifyUser'])->name('login.verifyUser');

// FORGOT/UPDATE PASSWORD ROUTES
// show change password otp form
Route::get('/forgotpassword', [UserController::class, 'showForgotForm'])->name('login.showForgotForm');
// send reset code
Route::post('/resetcode', [UserController::class, 'sendResetCode'])->name('send.reset_code');
// sends password otp, redirects to change password
// HAD TO CHANGE FROM POST TO GET
Route::get('/resetpassword', [UserController::class, 'showResetForm'])->name('login.showResetForm');
// updates new password
Route::post('/savepassword', [UserController::class, 'savePassword'])->name('login.savePassword');

// LOG USER OUT ROUTE
Route::post('/logout', [UserController::class, 'logoutUser'])->name('logout');
