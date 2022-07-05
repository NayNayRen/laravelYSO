<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deal extends Model
{
    use HasFactory;

    // public static function getFeatured($currentPage = null){
    //     $deals = Deal::get()->take(30); // get 30 deals

    //     $perPage = 3;
    //     $currentPage = $currentPage ?? 1;

    //     $pagination = new LengthAwarePaginator(
    //     $deals->slice($currentPage, $perPage),
    //     $deals->count(),
    //     $perPage,
    //     $currentPage,
    //         [
    //             'path' => request()->url(),
    //             'query' => request()->query(),
    //         ]
    //     );
    //     return $pagination;
    // }

    // CATEGORY METHOD
    // lists categories in dropdown menu
    public static function getCategories(){
        $categories = Deal::distinct()->orderBy('category')->pluck('category');
        return $categories;
    }

    // SEARCH METHOD
    // $q is used as a closure function to group queries together
    // $words is hoisted into the foreach scope
    public static function search(Request $request){
        $words = explode(' ', $request->search);
        $results = Deal::where(function ($q) use ($words) {
            foreach ($words as $word) {
                $q->orWhere('name', 'like', '%' . $word . '%')
                ->orWhere('location', 'like', '%' . $word . '%')
                ->orWhere('category', 'like', '%' . $word . '%');
            }
        })->paginate(8);
        return $results;
    }

    // INDEX FEATURED GROUPING, GETS 10, SORTS BY ID
    public static function getFeatured(){
        $featured = Deal::query()
        ->whereIn('id', Deal::select('id')->orderByDesc('id')->take(30)->get()->modelKeys())
        ->paginate(3, ['*'], 'featured');
        return $featured;
    }

    // VIEW ALL FEATURED GROUPING
    public static function viewAllFeatured(){
        $allFeatured = Deal::query()
        ->whereIn('id', Deal::select('id')->orderByDesc('id')->take(30)->get()->modelKeys())
        ->paginate(8);
        return $allFeatured;
    }

    // INDEX CATEGORY GROUPINGS, FOOD, TECH. ETC.
    public static function getType($type){
        $category = Deal::where('name', 'like', '%' . $type . '%')
        ->orWhere('location', 'like', '%' . $type . '%')
        ->orWhere('category', 'like', '%' . $type . '%')
        ->paginate(3, ['*'], $type);
        return $category;
    }

    // VIEW ALL CATEGORY GROUPING
    public static function viewAllType($type){
        $allCategory = Deal::where('name', 'like', '%' . $type . '%')
        ->orWhere('location', 'like', '%' . $type . '%')
        ->orWhere('category', 'like', '%' . $type . '%')
        ->paginate(8);
        return $allCategory;
    }

    // INDEX POPULAR GROUPING, PULLS DEALS WITH VIEWS GRETAER THAN 200
    public static function getPopular(){
        $popular = Deal::orderBy('views', 'asc')->where('views', '>', 200)->paginate(3, ['*'], 'popular');
        return $popular;
    }

    // VIEW ALL FEATURED GROUPING
    public static function viewAllPopular(){
        $allPopular = Deal::orderBy('views', 'asc')->where('views', '>', 200)->paginate(8);
        return $allPopular;
    }
}
