<?php

use App\Models\Deal;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DealController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NavigationPageController;

// MAIN/LANDING PAGE ROUTE
Route::get('/', [DealController::class, 'index']);

// SINGLE DEAL SELECTED ROUTE
Route::get('/deals/{deal}', [DealController::class, 'showDeal']);

// CATEGORY ROUTES
Route::get('/category_pages/featured', [DealController::class, 'allFeatured']);

Route::get('/category_pages/food', [DealController::class, 'allFood']);

Route::get('/category_pages/fashion', [DealController::class, 'allFashion']);

Route::get('/category_pages/tech', [DealController::class, 'allTech']);

Route::get('/category_pages/popular', [DealController::class, 'allPopular']);

// HEADER NAVIGATION ROUTES
Route::get('/navigation_pages/rewards', [NavigationPageController::class, 'rewards']);

Route::get('/navigation_pages/enhance', [NavigationPageController::class, 'enhance']);

Route::get('/navigation_pages/support', [NavigationPageController::class, 'support']);

Route::get('/navigation_pages/about', [NavigationPageController::class, 'about']);

// REGISTER, LOG IN, AND LOGOUT ROUTES
// shows register form
Route::get('/register', [UserController::class, 'showRegistrationForm']);
// registers user
Route::post('/user_pages', [UserController::class, 'registerUser']);
// shows log in form
Route::get('/login', [UserController::class, 'showLoginForm']);
// log user in
Route::post('/user_pages/authenticate', [UserController::class, 'loginUser']);
// logs user out
Route::post('/logout', [UserController::class, 'logoutUser']);