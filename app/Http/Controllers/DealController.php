<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Deal;
use App\Models\User;
use App\Models\Location;
use App\Models\Favourite;
use App\Models\UserCoupon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isEmpty;

class DealController extends Controller
{
    // INDEX PAGE AND DATA METHODS
    public function index(Request $request){
        // category input selection
        $food = $request->input('food');
        $fashion = $request->input('fashion');
        $auto = $request->input('auto');
        $fun = $request->input('fun');
        $health = $request->input('health');
        $categories = Deal::getCategories();
        $favorites = Deal::getUserFavorites();
        $coupons = Deal::getUserCoupons();
        $redeems = Deal::getUserRedeemedCoupons();
        // views based on selection
            if($food){
                return view('index', [
                    'favorites' => $favorites,
                    'coupons' => $coupons,
                    'redeems' => $redeems,
                    'featuredDeals' => Deal::getFeatured(),
                    'categoryDeals' => Deal::getType('food'),
                    'techDeals' => Deal::getType('tech'),
                    'popularDeals' => Deal::getPopular(),
                    'categories' => $categories,
                    'categoryHeading' => 'food',
                    'message' => '',
                    'pageTitle' => 'Home'
                ]);
            }elseif($fashion){
                return view('index', [
                    'favorites' => $favorites,
                    'coupons' => $coupons,
                    'redeems' => $redeems,
                    'featuredDeals' => Deal::getFeatured(),
                    'categoryDeals' => Deal::getType('fashion'),
                    'techDeals' => Deal::getType('tech'),
                    'popularDeals' => Deal::getPopular(),
                    'categories' => $categories,
                    'categoryHeading' => 'fashion',
                    'message' => '',
                    'pageTitle' => 'Home'
                ]);
            }elseif($auto){
                return view('index', [
                    'favorites' => $favorites,
                    'coupons' => $coupons,
                    'redeems' => $redeems,
                    'featuredDeals' => Deal::getFeatured(),
                    'categoryDeals' => Deal::getType('auto'),
                    'techDeals' => Deal::getType('tech'),
                    'popularDeals' => Deal::getPopular(),
                    'categories' => $categories,
                    'categoryHeading' => 'auto',
                    'message' => '',
                    'pageTitle' => 'Home'
                ]);
            }elseif($fun){
                return view('index', [
                    'favorites' => $favorites,
                    'coupons' => $coupons,
                    'redeems' => $redeems,
                    'featuredDeals' => Deal::getFeatured(),
                    'categoryDeals' => Deal::getType('fun'),
                    'techDeals' => Deal::getType('tech'),
                    'popularDeals' => Deal::getPopular(),
                    'categories' => $categories,
                    'categoryHeading' => 'fun',
                    'message' => '',
                    'pageTitle' => 'Home'
                ]);
            }elseif($health){
                return view('index', [
                    'favorites' => $favorites,
                    'coupons' => $coupons,
                    'redeems' => $redeems,
                    'featuredDeals' => Deal::getFeatured(),
                    'categoryDeals' => Deal::getType('health'),
                    'techDeals' => Deal::getType('tech'),
                    'popularDeals' => Deal::getPopular(),
                    'categories' => $categories,
                    'categoryHeading' => 'health',
                    'message' => '',
                    'pageTitle' => 'Home'
                ]);
            }else{
                return view('index', [
                    'favorites' => $favorites,
                    'coupons' => $coupons,
                    'redeems' => $redeems,
                    'featuredDeals' => Deal::getFeatured(),
                    'categoryDeals' => Deal::getType('food'),
                    'techDeals' => Deal::getType('tech'),
                    'popularDeals' => Deal::getPopular(),
                    'categories' => $categories,
                    'categoryHeading' => 'food',
                    'message' => '',
                    'pageTitle' => 'Home'
                ]);
            }
        }
    
    // SINGLED DEAL PAGE, REGISTERED AND NONREGISTERED VIEWS
    public function showDeal(Deal $deal, User $user){
        // if signed in
        if(Auth::check()){
            return view('registeredDeal', [
                'deal' => $deal,
                'user' => auth()->user(),
                'pageTitle' => 'Selected Deal'
            ]);
            // if not signed in
        }else{
            return view('unregisteredDeal', [
                'deal' => $deal,
                'pageTitle' => 'Selected Deal'
            ]);
        }
    }

    // SEARCHED DEALS RESULTS PAGE
    public function searchDeal(Request $request){
        $words = explode(' ', $request->search);
        $favorites = Deal::getUserFavorites();
        $coupons = Deal::getUserCoupons();
        $redeems = Deal::getUserRedeemedCoupons();
        $searchedLocations = Location::getSearchedLocations($request);
        $allSearchedLocations = Location::getAllLocations();
        // limits search to 3 words or less
        if(count($words) > 3){
            $results = 0;
            return view('category_pages/searchResults', [
                'favorites' => $favorites,
                'coupons' => $coupons,
                'redeems' => $redeems,
                'searchedDeals' => $results,
                'request' => $request,
                'searchedLocations' => [],
                'searchedWords' => $words,
                'message' => 'Limit your search to 3 words or less.',
                'pageTitle' => 'Search Results'
            ]);
        }
        // if nothing is typed, sets results to 0, essentially empty
        elseif($request->search === null){
            $results = 0;
            return view('category_pages/searchResults', [
                'favorites' => $favorites,
                'coupons' => $coupons,
                'redeems' => $redeems,
                'searchedDeals' => $results,
                'request' => $request,
                'searchedLocations' => [],
                'searchedWords' => ['no results'],
                'message' => 'Type something to search for.',
                'pageTitle' => 'Search Results'
            ]);
        // if all goes well
        }else{
            $results = Deal::search($request);
            return view('category_pages/searchResults', [
                'favorites' => $favorites,
                'coupons' => $coupons,
                'redeems' => $redeems,
                'searchedDeals' => $results,
                'request' => $request,
                'searchedLocations' => $searchedLocations,
                'searchedWords' => $words,
                'message' => '',
                'pageTitle' => 'Search Results'
            ]);
        }
    }

    // VIEW ALL FEATURED
    public function allFeatured(){
        $favorites = Deal::getUserFavorites();
        $coupons = Deal::getUserCoupons();
        $redeems = Deal::getUserRedeemedCoupons();
        return view('category_pages/featured', [
            'favorites' => $favorites,
            'coupons' => $coupons,
            'redeems' => $redeems,
            'deals' => Deal::viewAllFeatured(),
            'message' => '',
            'pageTitle' => 'Featured'
         ]);
    }

    // VIEW ALL FOOD
    public function allFood(){
        $favorites = Deal::getUserFavorites();
        $coupons = Deal::getUserCoupons();
        $redeems = Deal::getUserRedeemedCoupons();
        return view('category_pages/food', [
            'favorites' => $favorites,
            'coupons' => $coupons,
            'redeems' => $redeems,
            'deals' => Deal::viewAllType('food'),
            'message' => '',
            'pageTitle' => 'Food'
         ]);
    }

    // VIEW ALL FASHION
    public function allFashion(){
        $favorites = Deal::getUserFavorites();
        $coupons = Deal::getUserCoupons();
        $redeems = Deal::getUserRedeemedCoupons();
        return view('category_pages/fashion', [
            'favorites' => $favorites,
            'coupons' => $coupons,
            'redeems' => $redeems,
            'deals' => Deal::viewAllType('fashion'),
            'message' => '',
            'pageTitle' => 'Fashion'
         ]);
    }

    // VIEW ALL AUTO
    public function allAuto(){
        $favorites = Deal::getUserFavorites();
        $coupons = Deal::getUserCoupons();
        $redeems = Deal::getUserRedeemedCoupons();
        return view('category_pages/auto', [
            'favorites' => $favorites,
            'coupons' => $coupons,
            'redeems' => $redeems,
            'deals' => Deal::viewAllType('auto'),
            'message' => '',
            'pageTitle' => 'Auto'
         ]);
    }

    // VIEW ALL FUN
    public function allFun(){
        $favorites = Deal::getUserFavorites();
        $coupons = Deal::getUserCoupons();
        $redeems = Deal::getUserRedeemedCoupons();
        return view('category_pages/fun', [
            'favorites' => $favorites,
            'coupons' => $coupons,
            'redeems' => $redeems,
            'deals' => Deal::viewAllType('fun'),
            'message' => '',
            'pageTitle' => 'Fun'
         ]);
    }

    // VIEW ALL HEALTH
    public function allHealth(){
        $favorites = Deal::getUserFavorites();
        $coupons = Deal::getUserCoupons();
        $redeems = Deal::getUserRedeemedCoupons();
        return view('category_pages/health', [
            'favorites' => $favorites,
            'coupons' => $coupons,
            'redeems' => $redeems,
            'deals' => Deal::viewAllType('health'),
            'message' => '',
            'pageTitle' => 'Health'
         ]);
    }

    // VIEW ALL TECH
    public function allTech(){
        $favorites = Deal::getUserFavorites();
        $coupons = Deal::getUserCoupons();
        $redeems = Deal::getUserRedeemedCoupons();
        return view('category_pages/tech', [
            'favorites' => $favorites,
            'coupons' => $coupons,
            'redeems' => $redeems,
            'deals' => Deal::viewAllType('tech'),
            'message' => '',
            'pageTitle' => 'Tech'
        ]);
    }

    // VIEW ALL POPULAR
    public function allPopular(){
        $favorites = Deal::getUserFavorites();
        $coupons = Deal::getUserCoupons();
        $redeems = Deal::getUserRedeemedCoupons();
        return view('category_pages/popular', [
            'favorites' => $favorites,
            'coupons' => $coupons,
            'redeems' => $redeems,
            'deals' => Deal::viewAllPopular(),
            'message' => '',
            'pageTitle' => 'Popular'
        ]);
    }
}
