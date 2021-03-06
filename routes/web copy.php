<?php

use App\Models\Deal;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DealController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\NavigationPageController;

// MAIN/LANDING PAGE ROUTE
Route::get('/', [DealController::class, 'index'])->name('deals.index');

// SINGLE DEAL SELECTED ROUTE
Route::get('/deals/{deal}', [DealController::class, 'showDeal'])->name('deals.show');

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

// FAVOURITE ROUTES
Route::post('/favourite', [FavouriteController::class,'favouriteDeal'])->name('add.favourite');
Route::post('/coupon', [CouponController::class,'userCoupons'])->name('add.coupon');
Route::post('/code', [UserController::class,'sendCode'])->name('send.code');
Route::post('/resetcode', [UserController::class,'login.resetpasswrod'])->name('send.reset_code');



// REGISTER, LOG IN, AND LOGOUT ROUTES
// shows register form
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('user.create');
// registers user
Route::post('/user_pages', [UserController::class, 'registerUser'])->name('user.store');
// shows log in form
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login.showLoginForm');
// veriy email or password
Route::get('/verify/{id}', [UserController::class, 'showVerifyForm'])->name('login.showVerifyForm');
Route::post('/verify/code/{id}', [UserController::class, 'verifyForm'])->name('login.VerifyForm');

//forgot password
Route::get('/forgotpasswrod/', [UserController::class, 'showForgotForm'])->name('login.forgotpasswrod');
Route::post('/resetpasswrod/', [UserController::class, 'forgotForm'])->name('login.resetpasswrod');
Route::post('/savepasswrod/', [UserController::class, 'savePasswrod'])->name('login.savepasswrod');

// log user in
Route::post('/user_pages/authenticate', [UserController::class, 'loginUser'])->name('login');
// logs user out
Route::post('/logout', [UserController::class, 'logoutUser'])->name('logout');