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
        $searchResultsId =  Deal::where(function ($q) use ($words) {
            foreach ($words as $word) {
                $q->orWhere('name', 'like', '%' . $word . '%')
                ->orWhere('location', 'like', '%' . $word . '%')
                ->orWhere('category', 'like', '%' . $word . '%');
            }
        })->pluck('id');
        // matches plucked id to locations id for locations data
        // results have to be looped through
        // returned as an array
        $locationResults = Location::where(function ($q) use ($searchResultsId){
            foreach($searchResultsId as $resultId){
                $q->orWhere('id', '=', [$resultId]);
            }
        })->get();
        // dd($locationResults);
        return $locationResults;
        
    }
}
