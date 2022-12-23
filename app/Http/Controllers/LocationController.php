<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Location;
use App\Models\UserCoupon;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function showLocationDeals(Request $request, $locationId){
        $favorites = Favorite::getUserFavorites();
        $coupons = UserCoupon::getUserCoupons();
        $redeems = UserCoupon::getUserRedeemedCoupons();
        $locations = Location::getLocation($locationId);
        $locationDeals = Location::getLocationDeals($locationId);
        $submitMethod = $request->submit;
        // dd($submitMethod);
        return view('locationDeals', [
            'favorites' => $favorites,
            'coupons' => $coupons,
            'redeems' => $redeems,
            'locations' => $locations,
            'locationDeals' => $locationDeals,
            'message' => '',
            'pageTitle' => 'Location Deals',
            'submitMethod' => $submitMethod
        ]);
    }
}
