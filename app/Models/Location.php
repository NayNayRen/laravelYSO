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
        $locations = Location::orderBy('name')
        ->whereNotNull('lat')
        ->WhereNotNull('lon')->get();
        // dd($locations);
        return $locations;
    }

    // USES LOCATION ID FROM DEALS TO GET LOCATIONS
    public static function getSearchedLocations(Request $request){
        $words = explode(' ', $request->search);
        $dealResults = Deal::search($request);
        $locationResults = Location::orderBy('name')
        ->where(function ($q) use ($dealResults) {
            foreach ($dealResults as $dealResult) {
                $q->orWhere('id', $dealResult->location_id);
            }
        })
        // remove if doesnt work right
        // ->orWhere(function ($q) use ($words) {
        //     foreach ($words as $word) {
        //         $q->orWhere('name', 'like', '%' . $word . '%');
        //     }
        // })
        // 
        ->whereNotNull('lat')
        ->WhereNotNull('lon')->get();
        // dd($locationResults);
        return $locationResults;
    }

    // LOCATIONS FOR THE VIEW ALL MAPS
    public static function getMatchingLocations($type){
        $dealResults = Deal::viewAllType($type);
        $locationResults = Location::orderBy('name')
        ->where(function ($q) use ($dealResults) {
            foreach ($dealResults as $dealResult) {
                $q->orWhere('id', $dealResult->location_id);
            }
        })
        ->whereNotNull('lat')
        ->WhereNotNull('lon')->get();
        // dd($locationResults);
        return $locationResults;
    }

    // GETS FEATURED DEALS LOCATIONS
    public static function getFeaturedLocations(){
        $featuredDeals = Deal::viewAllFeatured();
        $locationResults = Location::orderBy('name')
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
        $popularDeals = Deal::viewAllPopular();
        $locationResults = Location::orderBy('name')
        ->where(function ($q) use ($popularDeals) {
            foreach ($popularDeals as $popularDeal) {
                $q->orWhere('id', $popularDeal->location_id);
            }
        })
        ->whereNotNull('lat')
        ->WhereNotNull('lon')->get();
        return $locationResults;
    }

    public static function getLocation($locationId){
        $location = Location::where('id', $locationId)->get();
        // dd($location);
        return $location;
    }

    public static function getLocationDeals($locationId){
        $locationDeals = Deal::orderBy('name')
        ->where('location_id', $locationId)->get();
        // dd($locationDeals);
        return $locationDeals;
    }

}
