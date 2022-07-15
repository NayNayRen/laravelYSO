<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\User;
use App\Models\Favourite;
use App\Models\UserCoupon;
use Illuminate\Http\Request;
use Carbon\Carbon;
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
        // return $request;
        $food = $request->input('food');
        $fashion = $request->input('fashion');
        $auto = $request->input('auto');
        $fun = $request->input('fun');
        $health = $request->input('health');
        $categories = Deal::getCategories();
        // return [$categories,$health,$fun,$auto,$fashion,$food];
        // views based on selection
        if($food){
            return view('index', [
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
            // return Deal::count(); 
            // return Deal::getFeatured()->count();
            // return Deal::getType('food')->count();
            // return Deal::getPopular()->count();
            // return auth()->user()->id;
            // return  Favourite::where('deal_id',37035)->where('user_id',5)->count(); 
            // if (auth()->user()->id)
            // {
            
            // }

            if ((auth()->user()))
            {
                $user_id = (auth()->user()->id);
                
                //favourite deals
                $favs = Favourite::where('user_id',$user_id)->get();
                $deals =  Deal::query();
                if($favs->count() > 0 )
                {
                    foreach($favs as $fav)
                    {
                        if($deals ==null)
                        {
                            $deals->where('id',$fav->deal_id);
                        }
                        else
                        {
                            $deals->orwhere('id',$fav->deal_id);
                        }
                    }
                    $deals = $deals->get();

                }
                else
                {
                    $deals = null;
                }
                
                //user coupons
                $cous = UserCoupon::where('user_id',$user_id)->get();
                $coupons =  Deal ::query();
                if($cous->count() > 0 )
                {
                    foreach($cous as $cou)
                    {
                        if($coupons ==null)
                        {
                            $coupons->where('id',$cou->deal_id);
                        }
                        else
                        {
                            $coupons->orwhere('id',$cou->deal_id);
                        }
                        // return $fav->id;
                    }
                    $coupons = $coupons->get();
                }
                else
                {
                    $coupons = null;
                }
                

                //Redeemed coupons
                $redms = UserCoupon::where('user_id',$user_id)->where('status',1)->get();
                $redeems =  Deal ::query();
                if($redms->count() > 0 )
                {
                    foreach($redms as $redm)
                    {
                        
                        if($redeems ==null)
                        {
                            $redeems->where('id',$redm->deal_id);
                        }
                        else
                        {
                            $redeems->orwhere('id',$redm->deal_id);
                        }
                        // return $fav->id;
                    }
                    $redeems = $redeems->get();
                }
                else
                {
                    $redeems = null;
                }
            }
            else
            {
                $deals = null;
                $coupons = null;
                $redeems = null;
            }
            
            
            // return $user;
            return view('index', [
                'deals' => $deals,
                'redeems' => $redeems,
                'coupons' => $coupons,
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
                'message' => 'Limit your search to 3 words or less.',
                'pageTitle' => 'Search Results'
            ]);
        }
        // if nothing is typed, sets results to 0, essentially empty
        elseif($request->search === null){
            $results = 0;
            return view('category_pages/searchResults', [
                'searchedDeals' => $results,
                'request' => $request,
                'searchedWords' => ['no results'],
                'message' => 'Type something to search for.',
                'pageTitle' => 'Search Results'
            ]);
        // if all goes well
        }else{
            $results = Deal::search($request);
            return view('category_pages/searchResults', [
                'searchedDeals' => $results,
                'request' => $request,
                'searchedWords' => $words,
                'message' => '',
                'pageTitle' => 'Search Results'
            ]);
        }
    }

    // VIEW ALL FEATURED
    public function allFeatured(){
        return view('category_pages/featured', [
            'deals' => Deal::viewAllFeatured(),
            'message' => '',
            'pageTitle' => 'Featured'
         ]);
    }

    // VIEW ALL FOOD
    public function allFood(){
        return view('category_pages/food', [
            'deals' => Deal::viewAllType('food'),
            'message' => '',
            'pageTitle' => 'Food'
         ]);
    }

    // VIEW ALL FASHION
    public function allFashion(){
        return view('category_pages/fashion', [
            'deals' => Deal::viewAllType('fashion'),
            'message' => '',
            'pageTitle' => 'Fashion'
         ]);
    }

    // VIEW ALL AUTO
    public function allAuto(){
        return view('category_pages/auto', [
            'deals' => Deal::viewAllType('auto'),
            'message' => '',
            'pageTitle' => 'Auto'
         ]);
    }

    // VIEW ALL FUN
    public function allFun(){
        return view('category_pages/fun', [
            'deals' => Deal::viewAllType('fun'),
            'message' => '',
            'pageTitle' => 'Fun'
         ]);
    }

    // VIEW ALL HEALTH
    public function allHealth(){
        return view('category_pages/health', [
            'deals' => Deal::viewAllType('health'),
            'message' => '',
            'pageTitle' => 'Health'
         ]);
    }

    // VIEW ALL TECH
    public function allTech(){
        return view('category_pages/tech', [
            'deals' => Deal::viewAllType('tech'),
            'message' => '',
            'pageTitle' => 'Tech'
        ]);
    }

    // VIEW ALL POPULAR
    public function allPopular(){
        return view('category_pages/popular', [
            'deals' => Deal::viewAllPopular(),
            'message' => '',
            'pageTitle' => 'Popular'
        ]);
    }
}
