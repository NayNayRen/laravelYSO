<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;

    // GETS ALL LOCATIONS
    public static function getAllLocations(){
        $locations = Location::orderBy('id', 'asc')->whereNotNull('lat')
        ->WhereNotNull('lon')->get();
        // dd($locations);
        return $locations;
    }

    // USES A SIMILAR SEARCH LIKE THE INPUT ONE
    public static function getSearchedLocations(Request $request){
        $words = explode(' ', $request->search);
        $locationResults =  Location::orderBy('id', 'asc')->where(function ($q) use ($words) {
            foreach ($words as $word) {
                $q->orWhere('name', 'like', '%' . $word . '%')
                ->orWhere('location', 'like', '%' . $word . '%')
                ->orWhere('type', 'like', '%' . $word . '%');
            }
        })
        ->whereNotNull('lat')
        ->WhereNotNull('lon')->get();
        // dd($locationResults);
        return $locationResults;
    }

    // LOCATIONS FOR VIEW ALL CATEGORY MAP
    public static function getMatchingLocations($type){
        $locationResults =  Location::orderBy('id', 'asc')
        ->where('name', 'like', '%' . $type . '%')
        ->orWhere('location', 'like', '%' . $type . '%')
        ->orWhere('type', 'like', '%' . $type . '%')
        ->whereNotNull('lat')
        ->WhereNotNull('lon')->get();
        // dd($locationResults);
        return $locationResults;
    }

    // matches location and search results, returns the location group
    // public static function getMatchingLocations(Request $request){
    //     $words = explode(' ', $request->search);
    //     $locationResults =  Location::orderBy('id', 'asc')->where(function ($q) use ($words) {
    //         foreach ($words as $word) {
    //             $q->orWhere('name', 'like', '%' . $word . '%')
    //             ->orWhere('location', 'like', '%' . $word . '%')
    //             ->orWhere('type', 'like', '%' . $word . '%');
    //         }
    //     })
    //     ->whereNotNull('lat')
    //     ->WhereNotNull('lon')->get();
    //     // dd($locationResults);
    //     $dealResults =  Deal::orderBy('id', 'asc')->where(function ($q) use ($words) {
    //         foreach ($words as $word) {
    //             $q->orWhere('name', 'like', '%' . $word . '%')
    //             ->orWhere('location', 'like', '%' . $word . '%')
    //             ->orWhere('category', 'like', '%' . $word . '%');
    //         }
    //     })->get();
    //     // dd($dealResults);
    //     $matchingDeals = $locationResults->diffKeys([$dealResults])->sort()->all();
    //     // dd($matchingDeals);
    //     return $matchingDeals;
    // }
}
