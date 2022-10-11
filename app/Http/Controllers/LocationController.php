<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function showLocationDeals($locationId){
        // dd($request);
        return view('locationDeals', [
            'locations' => Location::getLocation($locationId),
            'locationDeals' => Location::getLocationDeals($locationId),
            'message' => '',
            'pageTitle' => 'Location Deals'
        ]);
    }
}
