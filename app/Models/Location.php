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
        $dealResults = Deal::orderBy('id')->get();
        $locationIds = CouponLocation::whereIn('cid', $dealResults->pluck('id'));
        $locations = Location::orderBy('id')
        ->whereIn('id', $locationIds->pluck('lid'))
        ->whereNotNull('lat')
        ->WhereNotNull('lon')->get();
        // dd($locations);
        return $locations;
    }

    // USES LOCATION ID FROM DEALS TO GET LOCATIONS
    public static function getSearchedLocations(Request $request){
        // $dealResults = Deal::search($request);
        $words = explode(' ', $request->search);
        $dealResults = Deal::orderBy('name')
        ->where(function ($q) use ($words) {
            foreach ($words as $word) {
                $q->orWhere('name', 'like', '%' . $word . '%')
                ->orWhere('location', 'like', '%' . $word . '%')
                ->orWhere('category', 'like', '%' . $word . '%');
            }
        })->get();
        $locationIds = CouponLocation::whereIn('cid', $dealResults->pluck('id'));
        $locationResults = Location::orderBy('name')
        ->whereIn('id', $locationIds->pluck('lid'))
        ->whereNotNull('lat')
        ->whereNotNull('lon')
        ->get();
        // dd($locationResults);
        return $locationResults;
    }

    // LOCATIONS FOR THE VIEW ALL MAPS
    public static function getMatchingLocations($type){
        // $dealResults = Deal::viewAllType($type);
        $dealResults = Deal::orderBy('name')
        ->where('name', 'like', '%' . $type . '%')
        ->orWhere('location', 'like', '%' . $type . '%')
        ->orWhere('category', 'like', '%' . $type . '%')->get();
        $locationIds = CouponLocation::whereIn('cid', $dealResults->pluck('id'));
        $locationResults = Location::orderBy('name')
        ->whereIn('id', $locationIds->pluck('lid'))
        ->whereNotNull('lat')
        ->whereNotNull('lon')
        ->get();
        // dd($locationResults);
        return $locationResults;
    }

    // GETS FEATURED DEALS LOCATIONS
    public static function getFeaturedLocations(){
        // $dealResults = Deal::viewAllFeatured();
        $allFeatured = Deal::query()
        ->orderBy('name')
        ->whereIn('id', Deal::select('id')
        ->orderBy('id', 'asc')->take(30)
        ->get()->modelKeys());
        $locationIds = CouponLocation::whereIn('cid', $allFeatured->pluck('id'));
        $locationResults = Location::orderBy('name')
        ->whereIn('id', $locationIds->pluck('lid'))
        ->whereNotNull('lat')
        ->whereNotNull('lon')
        ->get();
        // dd($locationResults);
        return $locationResults;
    }

    // GETS POPULAR DEALS LOCATIONS
    public static function getPopularLocations(){
        // $dealResults = Deal::viewAllPopular();
        $dealResults = Deal::orderBy('views', 'asc')
        ->where('views', '>', 75)->get();
        $locationIds = CouponLocation::whereIn('cid', $dealResults->pluck('id'));
        $locationResults = Location::orderBy('name')
        ->whereIn('id', $locationIds->pluck('lid'))
        ->whereNotNull('lat')
        ->whereNotNull('lon')
        ->get();
        // dd($locationResults);
        return $locationResults;
    }

    // LAST 2 QUERY METHODS ARE USED IN THE SEPERATE/SOLO LOCATIONS PAGE
    public static function getLocation($locationId){
        $locationIds = CouponLocation::orderBy('id')
        ->where('lid', $locationId)->get();
        // dd($locationIds);
        $locations= Location::orderBy('name')
        ->whereIn('id', $locationIds->pluck('lid'))
        ->whereNotNull('lat')
        ->WhereNotNull('lon')->get();
        // dd($locations);
        return $locations;
    }

    public static function getLocationDeals($locationId){
        $locationIds = CouponLocation::orderBy('id')
        ->where('lid', $locationId)->get();
        // dd($locationIds);
        $locationDeals= Deal::orderBy('name')
        ->whereIn('id', $locationIds->pluck('cid'))->get();
        // dd($locationDeals);
        return $locationDeals;
    }

    public function joinedDeals(){
        return $this->belongsToMany(Deal::class, 'CouponLocations');
    }

}
