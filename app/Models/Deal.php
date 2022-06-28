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
    
    // public static function search(Request $request){
        //     $words = explode(' ', $request->search);
        //         return Deal::query()
        //         ->where('name', 'like', '%' . $request->search . '%')
        //         ->orWhere('location', 'like', '%' . $request->search . '%')
        //         ->orWhere('category', 'like', '%' . $request->search . '%')
        //         ->paginate(10);
        // }

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
        })->paginate(10);
        return $results;
    }

    // INDEX FEATURED GROUPING, GETS 10, SORTS BY ID
    public static function getFeatured(){
        return Deal::query()
        ->whereIn('id', Deal::select('id')->orderByDesc('id')->take(30)->get()->modelKeys())
        ->paginate(3, ['*'], 'featured');
    }

    // VIEW ALL FEATURED GROUPING
    public static function viewAllFeatured(){
        return Deal::query()
        ->whereIn('id', Deal::select('id')->orderByDesc('id')->take(30)->get()->modelKeys())
        ->paginate(10);
    }

    // INDEX CATEGORY GROUPINGS, FOOD, TECH. ETC.
    public static function getType($type){
        return Deal::where('category', '=', $type)->paginate(3, ['*'], $type);
    }

    // VIEW ALL CATEGORY GROUPING
    public static function viewAllType($type){
        return Deal::where('category', '=', $type)->paginate(10);
    }

    // INDEX POPULAR GROUPING, PULLS DEALS WITH VIEWS GRETAER THAN 200
    public static function getPopular(){
        return Deal::orderBy('views', 'asc')->where('views', '>', 200)->paginate(3, ['*'], 'popular');
    }

    // VIEW ALL FEATURED GROUPING
    public static function viewAllPopular(){
        return Deal::orderBy('views', 'asc')->where('views', '>', 200)->paginate(10);
    }
}
