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
        $locations = Location::orderBy('id', 'asc')->get()->modelKeys();
        $words = explode(' ', $request->search);
        $searchResults =  Deal::where(function ($q) use ($words) {
            foreach ($words as $word) {
                $q->orWhere('name', 'like', '%' . $word . '%')
                ->orWhere('location', 'like', '%' . $word . '%')
                ->orWhere('category', 'like', '%' . $word . '%');
            }
        })->get()->modelKeys();
        $locationResults = Location::select('id', '>', 100);
        return $locations;
    }
}
