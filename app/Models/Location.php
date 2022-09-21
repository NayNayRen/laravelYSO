<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;
    // gets all locations
    public static function getAllLocations(){
        $locations = Location::orderBy('id', 'asc')->get();
        return $locations;
    }
    // uses the search method from Deal model, plucks the id
    public static function getSearchedLocations(Request $request){
        $words = explode(' ', $request->search);
        $locationResults =  Location::orderBy('id', 'asc')->where(function ($q) use ($words) {
            foreach ($words as $word) {
                $q->orWhere('name', 'like', '%' . $word . '%')
                ->orWhere('location', 'like', '%' . $word . '%');
            }
        })->get();
        return $locationResults;
    }

    public static function getMatchingLocations(Request $request){
        $words = explode(' ', $request->search);
        $locationResults =  Location::orderBy('id', 'asc')->where(function ($q) use ($words) {
            foreach ($words as $word) {
                $q->orWhere('name', 'like', '%' . $word . '%')
                ->orWhere('location', 'like', '%' . $word . '%');
            }
        })->get();
        $dealResults =  Deal::orderBy('id', 'asc')->where(function ($q) use ($words) {
            foreach ($words as $word) {
                $q->orWhere('name', 'like', '%' . $word . '%')
                ->orWhere('location', 'like', '%' . $word . '%')
                ->orWhere('category', 'like', '%' . $word . '%');
            }
        })->get();
        $matchingDeals = $locationResults->diffKeys([$dealResults])->sort()->all();
        return $matchingDeals;
    }
}
