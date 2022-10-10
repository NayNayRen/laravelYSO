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

    // CATEGORY METHOD
    public static function getCategories(){
        $categories = Deal::distinct()
            ->orderBy('category')
            ->where('category', '!=', '')
            ->whereNotNull('category')
            ->pluck('category')
            ->flatMap(fn (string $categories) => explode(',', $categories)) // split at every comma to make the list
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
        $results = Deal::orderBy('id', 'asc')
        ->where(function ($q) use ($words) {
            foreach ($words as $word) {
                $q->orWhere('name', 'like', '%' . $word . '%')
                ->orWhere('location', 'like', '%' . $word . '%')
                ->orWhere('category', 'like', '%' . $word . '%');
            }
        })
        ->paginate(10);
        return $results;
    }

    // INDEX FEATURED GROUPING, GETS 10, SORTS BY ID
    public static function getFeatured(){
        $take = 30;
        $featured = Deal::query()
        ->whereIn('id', Deal::select('id')
        ->orderBy('id', 'asc')
        ->take($take)->get()->modelKeys())
        ->paginate($take, ['*'], 'featured');
        return $featured;
    }

    // VIEW ALL FEATURED GROUPING
    public static function viewAllFeatured(){
        $take = 30;
        $allFeatured = Deal::query()
        ->whereIn('id', Deal::select('id')
        ->orderBy('id', 'asc')->take($take)
        ->get()->modelKeys())
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
        $popular = Deal::orderBy('views', 'asc')
        ->where('views', '>', 75)
        ->paginate(30, ['*'], 'popular');
        return $popular;
    }

    // VIEW ALL FEATURED GROUPING
    public static function viewAllPopular(){
        $allPopular = Deal::orderBy('views', 'asc')
        ->where('views', '>', 75)
        ->paginate(10);
        return $allPopular;
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    // public function locations(){
    //     return $this->belongsTo(Location::class);
    // }
}
