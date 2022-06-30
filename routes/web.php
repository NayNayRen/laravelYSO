<?php

use App\Models\Deal;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DealController;
use App\Http\Controllers\UserController;
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

Route::get('/category_pages/tech', [DealController::class, 'allTech'])->name('deals.tech');

Route::get('/category_pages/popular', [DealController::class, 'allPopular'])->name('deals.popular');

// HEADER NAVIGATION ROUTES
Route::get('/navigation_pages/rewards', [NavigationPageController::class, 'rewards'])->name('rewards');

Route::get('/navigation_pages/enhance', [NavigationPageController::class, 'enhance'])->name('enhance');

Route::get('/navigation_pages/support', [NavigationPageController::class, 'support'])->name('support');

Route::get('/navigation_pages/about', [NavigationPageController::class, 'about'])->name('about');

// REGISTER, LOG IN, AND LOGOUT ROUTES
// shows register form
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('user.create');
// registers user
Route::post('/user_pages', [UserController::class, 'registerUser'])->name('user.store');
// shows log in form
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login.showLoginForm');
// log user in
Route::post('/user_pages/authenticate', [UserController::class, 'loginUser'])->name('login');
// logs user out
Route::post('/logout', [UserController::class, 'logoutUser'])->name('logout');