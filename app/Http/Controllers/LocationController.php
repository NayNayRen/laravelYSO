<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function showLocationDeals($location){
        // dd($request);
        return view('locationDeals', [
            'locations' => Location::getLocation($location),
            'locationDeals' => Location::getLocationDeals($location),
            'message' => '',
            'pageTitle' => 'Location Deals'
        ]);
    }
}
