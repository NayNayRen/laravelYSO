<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Pagination\LengthAwarePaginator;

class Deal extends Model
{
    use HasFactory;

    // INDEX FEATURED GROUPING, GETS 10, SORTS BY ID
    public static function getFeatured(){
        return Deal::query()
        ->whereIn('id', Deal::select('id')->orderByDesc('id')->take(30)->get()->modelKeys())
        ->paginate(3, ['*'], 'featured');
    }

//     public static function getFeatured($currentPage = null)
// {
//     $deals = Deal::get()->take(30); // get 30 deals

//     $perPage = 3;
//     $currentPage = $currentPage ?? 1;

//     $pagination = new LengthAwarePaginator(
//     $deals->slice($currentPage, $perPage),
//     $deals->count(),
//     $perPage,
//     $currentPage,
//     [
//         'path' => request()->url(),
//         'query' => request()->query(),
//     ]
// );
//   return $pagination;
// }

    // VIEW ALL FEATURED GROUPING
    public static function viewAllFeatured(){
        return Deal::query()
        ->whereIn('id', Deal::select('id')->orderByDesc('id')->take(30)->get()->modelKeys())
        ->paginate(6);
    }

    // INDEX CATEGORY GROUPINGS, FOOD, TECH. ETC.
    public static function getType($type){
        return Deal::where('category', '=', $type)->paginate(3, ['*'], $type);
    }

    // VIEW ALL CATEGORY GROUPING
    public static function viewAllType($type){
        return Deal::where('category', '=', $type)->paginate(6);
    }

    // INDEX POPULAR GROUPING, PULLS DEALS WITH VIEWS GRETAER THAN 200
    public static function getPopular(){
        return Deal::orderBy('views', 'asc')->where('views', '>', 200)->paginate(3, ['*'], 'popular');
    }

    // VIEW ALL FEATURED GROUPING
    public static function viewAllPopular(){
        return Deal::orderBy('views', 'asc')->where('views', '>', 200)->paginate(6);
    }
}
