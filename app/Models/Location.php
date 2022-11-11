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
        $dealResults = Deal::search($request);
        $locationIds = CouponLocation::orderBy('id')
        ->where(function($q) use ($dealResults) {
            foreach($dealResults as $dealResult) {
                $q->orWhere('cid', $dealResult->id);
            }
        })->get();
        $locationResults = Location::orderBy('name')
        ->where(function ($q) use ($locationIds) {
            foreach ($locationIds as $locationId) {
                $q->orWhere('id', $locationId->lid);
            }
        })
        ->whereNotNull('lat')
        ->WhereNotNull('lon')->get();
        // dd($locationResults);
        return $locationResults;
    }

    // LOCATIONS FOR THE VIEW ALL MAPS
    public static function getMatchingLocations($type){
        $dealResults = Deal::viewAllType($type);
        $locationIds = CouponLocation::orderBy('id')
        ->where(function($q) use ($dealResults) {
            foreach($dealResults as $dealResult) {
                $q->orWhere('cid', $dealResult->id);
            }
        })->get();
        // dd($locationIds);
        $locationResults = Location::orderBy('name')
        ->where(function ($q) use ($locationIds) {
            foreach ($locationIds as $locationId) {
                $q->orWhere('id', $locationId->lid);
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
        $locationIds = CouponLocation::orderBy('id')
        ->where(function($q) use ($featuredDeals) {
            foreach($featuredDeals as $featuredDeal) {
                $q->orWhere('cid', $featuredDeal->id);
            }
        })->get();
        // dd($locationIds);
        $locationResults = Location::orderBy('name')
        ->where(function ($q) use ($locationIds) {
            foreach ($locationIds as $locationId) {
                $q->orWhere('id', $locationId->lid);
            }
        })
        ->whereNotNull('lat')
        ->WhereNotNull('lon')->get();
        return $locationResults;
    }

    // GETS POPULAR DEALS LOCATIONS
    public static function getPopularLocations(){
        $popularDeals = Deal::viewAllPopular();
        $locationIds = CouponLocation::orderBy('id')
        ->where(function($q) use ($popularDeals) {
            foreach($popularDeals as $popularDeal) {
                $q->orWhere('cid', $popularDeal->id);
            }
        })->get();
        $locationResults = Location::orderBy('name')
        ->where(function ($q) use ($locationIds) {
            foreach ($locationIds as $locationId) {
                $q->orWhere('id', $locationId->lid);
            }
        })
        ->whereNotNull('lat')
        ->WhereNotNull('lon')->get();
        return $locationResults;
    }

    // LAST 2 QUERY METHODS ARE USED IN THE SEPERATE LOCATIONS PAGE
    public static function getLocation($locationId){
        $locationIds = CouponLocation::orderBy('id')
        ->where('lid', $locationId)->get();
        // dd($locationIds);
        $locations= Location::orderBy('name')
        ->where(function($q) use ($locationIds) {
            foreach ($locationIds as $locationId) {
                $q->orWhere('id', $locationId->lid);
            }
        })->get();
        // dd($locations);
        return $locations;
    }

    public static function getLocationDeals($locationId){
        $locationIds = CouponLocation::orderBy('id')
        ->where('lid', $locationId)->get();
        // dd($location);
        $locationDeals= Deal::orderBy('name')
        ->where(function($q) use ($locationIds) {
            foreach ($locationIds as $locationId) {
                $q->orWhere('id', $locationId->cid);
            }
        })->get();
        // dd($locationDeals);
        return $locationDeals;
    }

    public function joinedDeals(){
        return $this->belongsToMany(Deal::class, 'CouponLocations');
    }

}
