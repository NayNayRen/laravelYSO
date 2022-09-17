<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;

    public static function getAllLocations(){
        $locations = Location::orderBy('id', 'asc')->get();
        return $locations;
    }

    public static function getSearchedLocations(Request $request){
        $locations = Location::orderBy('id', 'asc')->get();
        $searchResults = Deal::search($request);
        // $locationsResults = Location::where('id', '=', $searchResults->items['id'])->get();
        // dd($searchResults->items()[0]->attributes['id']);
        // dd($searchResults);
        return $searchResults;
    }
}
