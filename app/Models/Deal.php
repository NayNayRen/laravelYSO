<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Deal extends Model
{
    use HasFactory;

    // GET USERS FAVORITES
    // public static function getUserFavorites(){
    //     if ((auth()->user())){
    //         $user_id = (auth()->user()->id);               
    //         $favs = Favourite::where('user_id',$user_id)->get();
    //         $favorites =  Deal::query();
    //         if($favs->count() > 0 ){
    //             foreach($favs as $fav){
    //                 if($favorites == null){
    //                     $favorites->where('id',$fav->deal_id);
    //                 }else{
    //                     $favorites->orwhere('id',$fav->deal_id);
    //                 }
    //             }
    //                 $favorites = $favorites->get();
    //             }else{
    //                 $favorites = null;
    //             }
    //         }else{
    //             $favorites = null;
    //     }
    //     return $favorites;
    // }

    // GET USERS COUPONS
    // public static function getUserCoupons(){
    //     if ((auth()->user())){
    //         $user_id = (auth()->user()->id);               
    //         $cous = UserCoupon::where('user_id',$user_id)->get();
    //         $coupons =  Deal ::query();
    //         if($cous->count() > 0 ){
    //             foreach($cous as $cou){
    //                 if($coupons == null){
    //                     $coupons->where('id',$cou->deal_id);
    //                 }else{
    //                     $coupons->orwhere('id',$cou->deal_id);
    //                 }
    //             }
    //             $coupons = $coupons->get();
    //         }else{
    //             $coupons = null;
    //         }
    //     }else{
    //         $coupons = null;
    //     }
    //     return $coupons;
    // }

    // GET USERS REDEEMED COUPONS
    // public static function getUserRedeemedCoupons(){
    //     if ((auth()->user())){
    //         $user_id = (auth()->user()->id);               
    //         $redms = UserCoupon::where('user_id',$user_id)->where('status',1)->get();
    //         $redeems =  Deal ::query();
    //         if($redms->count() > 0 ){
    //             foreach($redms as $redm){
    //                 if($redeems == null){
    //                     $redeems->where('id',$redm->deal_id);
    //                 }else{
    //                     $redeems->orwhere('id',$redm->deal_id);
    //                 }
    //             }
    //             $redeems = $redeems->get();
    //         }else{
    //             $redeems = null;
    //         }
    //     }else{
    //         $redeems = null;
    //     }
    //     return $redeems;
    // }

    // CATEGORY METHOD
    public static function getCategories(){
        $categories = Deal::distinct()
            ->orderBy('category')
            ->where('category', '!=', '')
            ->whereNotNull('category')
            ->pluck('category')
            ->flatMap(fn (string $categories) => explode(',', $categories)) // split at every coma to make the list
            ->map(fn (string $category) => ucfirst(trim($category))) // cleanup and format the data with ucfirst
            ->unique() // ensure no duplicates exist
            ->sort() // sort alphabetically
            ->all(); // cast the collection to an array
            // dd($categories);
            return $categories;
    }

    // SEARCH METHOD
    // $q is used as a closure function to group queries together
    // $words is hoisted into the foreach scope
    public static function search(Request $request){
        $words = explode(' ', $request->search);
        $results = Deal::orderBy('id', 'asc')->where(function ($q) use ($words) {
            foreach ($words as $word) {
                $q->orWhere('name', 'like', '%' . $word . '%')
                ->orWhere('location', 'like', '%' . $word . '%')
                ->orWhere('category', 'like', '%' . $word . '%');
            }
        })->paginate(10);
        return $results;
    }

    // INDEX FEATURED GROUPING, GETS 10, SORTS BY ID
    public static function getFeatured(){
        $take = 30;
        $featured = Deal::query()
        ->whereIn('id', Deal::select('id')->orderBy('id', 'asc')->take($take)->get()->modelKeys())
        ->paginate($take, ['*'], 'featured');
        return $featured;
    }

    // VIEW ALL FEATURED GROUPING
    public static function viewAllFeatured(){
        $take = 60;
        $allFeatured = Deal::query()
        ->whereIn('id', Deal::select('id')->orderBy('id', 'asc')->take($take)->get()->modelKeys())
        ->paginate(10);
        return $allFeatured;
    }

    // INDEX CATEGORY GROUPINGS, FOOD, TECH. ETC.
    public static function getType($type){
        $take = $category = Deal::where('name', 'like', '%' . $type . '%')
        ->orWhere('location', 'like', '%' . $type . '%')
        ->orWhere('category', 'like', '%' . $type . '%')->count();

        $category = Deal::where('name', 'like', '%' . $type . '%')
        ->orWhere('location', 'like', '%' . $type . '%')
        ->orWhere('category', 'like', '%' . $type . '%')
        ->paginate($take, ['*'], $type);
        return $category;
    }

    // VIEW ALL CATEGORY GROUPING
    public static function viewAllType($type){
        $allCategory = Deal::where('name', 'like', '%' . $type . '%')
        ->orWhere('location', 'like', '%' . $type . '%')
        ->orWhere('category', 'like', '%' . $type . '%')
        ->paginate(10);
        return $allCategory;
    }

    // INDEX POPULAR GROUPING, PULLS DEALS WITH VIEWS GRETAER THAN 200
    public static function getPopular(){
        $popular = Deal::orderBy('views', 'asc')->where('views', '>', 200)->paginate(30, ['*'], 'popular');
        return $popular;
    }

    // VIEW ALL FEATURED GROUPING
    public static function viewAllPopular(){
        $allPopular = Deal::orderBy('views', 'asc')->where('views', '>', 200)->paginate(10);
        return $allPopular;
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
