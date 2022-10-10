<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Deal;
use App\Models\User;
use App\Models\Location;
use App\Models\Favorite;
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
        $favorites = Favorite::getUserFavorites();
        $coupons = UserCoupon::getUserCoupons();
        $redeems = UserCoupon::getUserRedeemedCoupons();
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
                    'locations' => [],
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
                    'locations' => [],
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
                    'locations' => [],
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
                    'locations' => [],
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
                    'locations' => [],
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
                    'locations' => [],
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
        $favorites = Favorite::getUserFavorites();
        $coupons = UserCoupon::getUserCoupons();
        $redeems = UserCoupon::getUserRedeemedCoupons();
        $searchedLocations = Location::getSearchedLocations($request);
        // limits search to 3 words or less
        if(count($words) > 3){
            $results = 0;
            return view('category_pages/searchResults', [
                'favorites' => $favorites,
                'coupons' => $coupons,
                'redeems' => $redeems,
                'searchedDeals' => $results,
                'request' => $request,
                'locations' => [],
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
                'locations' => [],
                'searchedWords' => ['no results found'],
                'message' => 'Enter something to search for.',
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
                'locations' => $searchedLocations,
                'searchedWords' => $words,
                'message' => '',
                'pageTitle' => 'Search Results'
            ]);
        }
    }

    // VIEW ALL FEATURED
    public function allFeatured(){
        $favorites = Favorite::getUserFavorites();
        $coupons = UserCoupon::getUserCoupons();
        $redeems = UserCoupon::getUserRedeemedCoupons();
        $featuredLocations = Location::getFeaturedLocations();
        return view('category_pages/featured', [
            'favorites' => $favorites,
            'coupons' => $coupons,
            'redeems' => $redeems,
            'deals' => Deal::viewAllFeatured(),
            'locations' => $featuredLocations,
            'message' => '',
            'pageTitle' => 'Featured'
         ]);
    }

    // VIEW ALL FOOD
    public function allFood(){
        $favorites = Favorite::getUserFavorites();
        $coupons = UserCoupon::getUserCoupons();
        $redeems = UserCoupon::getUserRedeemedCoupons();
        $matchingLocations = Location::getMatchingLocations('food');
        return view('category_pages/food', [
            'favorites' => $favorites,
            'coupons' => $coupons,
            'redeems' => $redeems,
            'deals' => Deal::viewAllType('food'),
            'locations' => $matchingLocations,
            'message' => '',
            'pageTitle' => 'Food'
         ]);
    }

    // VIEW ALL FASHION
    public function allFashion(){
        $favorites = Favorite::getUserFavorites();
        $coupons = UserCoupon::getUserCoupons();
        $redeems = UserCoupon::getUserRedeemedCoupons();
        $matchingLocations = Location::getMatchingLocations('fashion');
        return view('category_pages/fashion', [
            'favorites' => $favorites,
            'coupons' => $coupons,
            'redeems' => $redeems,
            'deals' => Deal::viewAllType('fashion'),
            'locations' => $matchingLocations,
            'message' => '',
            'pageTitle' => 'Fashion'
         ]);
    }

    // VIEW ALL AUTO
    public function allAuto(){
        $favorites = Favorite::getUserFavorites();
        $coupons = UserCoupon::getUserCoupons();
        $redeems = UserCoupon::getUserRedeemedCoupons();
        $matchingLocations = Location::getMatchingLocations('automotive');
        return view('category_pages/auto', [
            'favorites' => $favorites,
            'coupons' => $coupons,
            'redeems' => $redeems,
            'deals' => Deal::viewAllType('automotive'),
            'locations' => $matchingLocations,
            'message' => '',
            'pageTitle' => 'Auto'
         ]);
    }

    // VIEW ALL FUN
    public function allFun(){
        $favorites = Favorite::getUserFavorites();
        $coupons = UserCoupon::getUserCoupons();
        $redeems = UserCoupon::getUserRedeemedCoupons();
        $matchingLocations = Location::getMatchingLocations('fun');
        return view('category_pages/fun', [
            'favorites' => $favorites,
            'coupons' => $coupons,
            'redeems' => $redeems,
            'deals' => Deal::viewAllType('fun'),
            'locations' => $matchingLocations,
            'message' => '',
            'pageTitle' => 'Fun'
         ]);
    }

    // VIEW ALL HEALTH
    public function allHealth(){
        $favorites = Favorite::getUserFavorites();
        $coupons = UserCoupon::getUserCoupons();
        $redeems = UserCoupon::getUserRedeemedCoupons();
        $matchingLocations = Location::getMatchingLocations('health');
        return view('category_pages/health', [
            'favorites' => $favorites,
            'coupons' => $coupons,
            'redeems' => $redeems,
            'deals' => Deal::viewAllType('health'),
            'locations' => $matchingLocations,
            'message' => '',
            'pageTitle' => 'Health'
         ]);
    }

    // VIEW ALL TECH
    public function allTech(){
        $favorites = Favorite::getUserFavorites();
        $coupons = UserCoupon::getUserCoupons();
        $redeems = UserCoupon::getUserRedeemedCoupons();
        $matchingLocations = Location::getMatchingLocations('tech');
        return view('category_pages/tech', [
            'favorites' => $favorites,
            'coupons' => $coupons,
            'redeems' => $redeems,
            'deals' => Deal::viewAllType('tech'),
            'locations' => $matchingLocations,
            'message' => '',
            'pageTitle' => 'Tech'
        ]);
    }

    // VIEW ALL POPULAR
    public function allPopular(){
        $favorites = Favorite::getUserFavorites();
        $coupons = UserCoupon::getUserCoupons();
        $redeems = UserCoupon::getUserRedeemedCoupons();
        $popularLocations = Location::getPopularLocations();
        return view('category_pages/popular', [
            'favorites' => $favorites,
            'coupons' => $coupons,
            'redeems' => $redeems,
            'deals' => Deal::viewAllPopular(),
            'locations' => $popularLocations,
            'message' => '',
            'pageTitle' => 'Popular'
        ]);
    }
}
