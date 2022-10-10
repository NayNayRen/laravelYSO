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
        $locations = Location::orderBy('id', 'asc')
        ->whereNotNull('lat')
        ->WhereNotNull('lon')->get();
        // dd($locations);
        return $locations;
    }

    // USES LOCATION ID FROM DEALS TO GET LOCATIONS
    public static function getSearchedLocations(Request $request){
        $words = explode(' ', $request->search);
        $dealResults = Deal::orderBy('id', 'asc')
        ->where(function ($q) use ($words) {
            foreach ($words as $word) {
                $q->orWhere('name', 'like', '%' . $word . '%')
                ->orWhere('location', 'like', '%' . $word . '%')
                ->orWhere('category', 'like', '%' . $word . '%');
            }
        })->get();

        $locationResults = Location::orderBy('id', 'asc')
        ->where(function ($q) use ($dealResults) {
            foreach ($dealResults as $dealResult) {
                $q->orWhere('id', $dealResult->location_id);
            }
        })
        ->orWhere(function ($q) use ($words) {
            foreach ($words as $word) {
                $q->orWhere('name', 'like', '%' . $word . '%')
                ->orWhere('type', 'like', '%' . $word . '%');
            }
        })
        ->whereNotNull('lat')
        ->WhereNotNull('lon')->get();
        // dd($locationResults);
        return $locationResults;
    }

    // LOCATIONS FOR THE VIEW ALL MAPS
    public static function getMatchingLocations($type){
        $dealResults = Deal::orderBy('id', 'asc')
        ->where('name', 'like', '%' . $type . '%')
        ->orWhere('location', 'like', '%' . $type . '%')
        ->orWhere('category', 'like', '%' . $type . '%')->get();

        $locationResults = Location::orderBy('id', 'asc')
        ->where(function ($q) use ($dealResults) {
            foreach ($dealResults as $dealResult) {
                $q->orWhere('id', $dealResult->location_id);
            }
        })
        ->orWhere('name', 'like', '%' . $type . '%')
        ->orWhere('type', 'like', '%' . $type . '%')
        ->whereNotNull('lat')
        ->WhereNotNull('lon')->get();
        // dd($locationResults);
        return $locationResults;
    }

    // GETS FEATURED DEALS LOCATIONS
    public static function getFeaturedLocations(){
        // $take = 30;
        // $featuredDeals = Deal::orderBy('id', 'asc')
        // ->take($take)->get();
        $featuredDeals = Deal::viewAllFeatured();
        $locationResults = Location::orderBy('id', 'asc')
        ->where(function ($q) use ($featuredDeals) {
            foreach ($featuredDeals as $featuredDeal) {
                $q->orWhere('id', $featuredDeal->location_id);
            }
        })
        ->whereNotNull('lat')
        ->WhereNotNull('lon')->get();
        return $locationResults;
    }

    // GETS POPULAR DEALS LOCATIONS
    public static function getPopularLocations(){
        // $popularDeals = Deal::orderBy('views', 'asc')
        // ->where('views', '>', 75)->get();
        $popularDeals = Deal::viewAllPopular();
        $locationResults = Location::orderBy('id', 'asc')
        ->where(function ($q) use ($popularDeals) {
            foreach ($popularDeals as $popularDeal) {
                $q->orWhere('id', $popularDeal->location_id);
            }
        })
        ->whereNotNull('lat')
        ->WhereNotNull('lon')->get();
        return $locationResults;
    }
    
    // public function deals(){
    //     return $this->hasMany(Deal::class);
    // }
}
