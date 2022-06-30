<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class DealController extends Controller
{

//     public function index(Request $request){
//         return view('index', [
//             'featuredDeals' => Deal::getFeatured($request->currentPage),
//             'foodDeals' => Deal::getType('Restaurant'),
//             'fashionDeals' => Deal::getType('Nail Salon'),
//             'techDeals' => Deal::getType('Pizza'),
//             'popularDeals' => Deal::getPopular()
//         ]);
// }

    // INDEX PAGE AND DATA METHODS
    public function index(Request $request){
        // category input selection
        $food = $request->input('food');
        $fashion = $request->input('fashion');
        $auto = $request->input('auto');
        $fun = $request->input('fun');
        $health = $request->input('health');
        // return view('index', [
        //     'featuredDeals' => Deal::getFeatured(),
        //     'categoryDeals' => Deal::getType('food'),
        //     'techDeals' => Deal::getType('tech'),
        //     'popularDeals' => Deal::getPopular(),
        //     'categoryHeading' => 'food'
        // ]);
        // views based on selection
        if($food){
            return view('index', [
                'featuredDeals' => Deal::getFeatured(),
                'categoryDeals' => Deal::getType('food'),
                'techDeals' => Deal::getType('tech'),
                'popularDeals' => Deal::getPopular(),
                'categoryHeading' => 'food'
            ]);
        }elseif($fashion){
            return view('index', [
                'featuredDeals' => Deal::getFeatured(),
                'categoryDeals' => Deal::getType('fashion'),
                'techDeals' => Deal::getType('tech'),
                'popularDeals' => Deal::getPopular(),
                'categoryHeading' => 'fashion'
            ]);
        }elseif($auto){
            return view('index', [
                'featuredDeals' => Deal::getFeatured(),
                'categoryDeals' => Deal::getType('auto'),
                'techDeals' => Deal::getType('tech'),
                'popularDeals' => Deal::getPopular(),
                'categoryHeading' => 'auto'
            ]);
        }elseif($fun){
            return view('index', [
                'featuredDeals' => Deal::getFeatured(),
                'categoryDeals' => Deal::getType('fun'),
                'techDeals' => Deal::getType('tech'),
                'popularDeals' => Deal::getPopular(),
                'categoryHeading' => 'fun'
            ]);
        }elseif($health){
            return view('index', [
                'featuredDeals' => Deal::getFeatured(),
                'categoryDeals' => Deal::getType('health'),
                'techDeals' => Deal::getType('tech'),
                'popularDeals' => Deal::getPopular(),
                'categoryHeading' => 'health'
            ]);
        }else{
            return view('index', [
                'featuredDeals' => Deal::getFeatured(),
                'categoryDeals' => Deal::getType('food'),
                'techDeals' => Deal::getType('tech'),
                'popularDeals' => Deal::getPopular(),
                'categoryHeading' => 'food'
            ]);
        }
    }
    
    // SINGLED DEAL PAGE, SHOWS REGISTERED AND NONREGISTERED VIEWS
    public function showDeal(Deal $deal, User $user){
        // if signed in
        if(Auth::check()){
            return view('registeredDeal', [
                'deal' => $deal,
                'user' => auth()->user()
            ]);
            // if not signed in
        }else{
            return view('unregisteredDeal', [
                'deal' => $deal
            ]);
        }
    }

    // SEARCHED DEALS RESULTS PAGE
    public function searchDeal(Request $request){
        $words = explode(' ', $request->search);
        // limits search to 3 words or less
        if(count($words) > 3){
            $results = 0;
            return view('category_pages/searchResults', [
                'searchedDeals' => $results,
                'request' => $request,
                'searchedWords' => $words,
                'message' => 'Limit your search to 3 words or less.'
            ]);
        }
        // if nothing is typed, sets results to 0, essentially empty
        elseif($request->search === null){
            $results = 0;
            return view('category_pages/searchResults', [
                'searchedDeals' => $results,
                'request' => $request,
                'searchedWords' => ['no results'],
                'message' => 'Type something to search for.'
            ]);
        // if all goes well
        }else{
            $results = Deal::search($request);
            return view('category_pages/searchResults', [
                'searchedDeals' => $results,
                'request' => $request,
                'searchedWords' => $words,
                'message' => ''
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
            'deals' => Deal::viewAllType('food') 
         ]);
    }

    // VIEW ALL FASHION
    public function allFashion(){
        return view('category_pages/fashion', [
            'deals' => Deal::viewAllType('fashion') 
         ]);
    }

    // VIEW ALL TECH
    public function allTech(){
        return view('category_pages/tech', [
            'deals' => Deal::viewAllType('tech')
        ]);
    }

    // VIEW ALL POPULAR
    public function allPopular(){
        return view('category_pages/popular', [
            'deals' => Deal::viewAllPopular()
        ]);
    }
}
