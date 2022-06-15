<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DealController extends Controller
{
    // INDEX PAGE AND DATA METHODS
    public function index(){
            return view('index', [
                'featuredDeals' => Deal::getFeatured(),
                'foodDeals' => Deal::getType('Restaurant'),
                'fashionDeals' => Deal::getType('Nail Salon'),
                'techDeals' => Deal::getType('Pizza'),
                'popularDeals' => Deal::getPopular()
            ]);
    }
    // SINGLED DEAL PAGE, SHOWS REGISTERED AND NONREGISTERED VIEWS
    public function showDeal(Deal $deal, User $user){
        if(Auth::check()){
            return view('registeredDeal', [
                'deal' => $deal,
                'user' => auth()->user()
            ]);
        }else{
            return view('unregisteredDeal', [
                'deal' => $deal
            ]);
        }
    }
    // VIEW ALL FEATURED
    public function allFeatured(){
        return view('category_pages/featured', [
            'deals' => Deal::viewAllFeatured() 
         ]);
    }
    // VIEW ALL FOOD
    public function allFood(){
        return view('category_pages/food', [
            'deals' => Deal::viewAllType('Restaurant') 
         ]);
    }
    // VIEW ALL FASHION
    public function allFashion(){
        return view('category_pages/fashion', [
            'deals' => Deal::viewAllType('Nail Salon') 
         ]);
    }
    // VIEW ALL TECH
    public function allTech(){
        return view('category_pages/tech', [
            'deals' => Deal::viewAllType('Pizza')
        ]);
    }
    // VIEW ALL POPULAR
    public function allPopular(){
        return view('category_pages/popular', [
            'deals' => Deal::viewAllPopular()
        ]);
    }
}
