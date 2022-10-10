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
        $locations = Location::orderBy('id', 'asc')
        ->whereNotNull('lat')
        ->WhereNotNull('lon')->get();
        // dd($locations);
        return $locations;
    }

    // USES A SIMILAR SEARCH LIKE THE INPUT ONE
    // public static function getSearchedLocations(Request $request){
    //     $words = explode(' ', $request->search);
    //     $locationResults =  Location::orderBy('id', 'asc')
    //     ->where(function ($q) use ($words) {
    //         foreach ($words as $word) {
    //             $q->orWhere('name', 'like', '%' . $word . '%')
    //             ->orWhere('location', 'like', '%' . $word . '%')
    //             ->orWhere('type', 'like', '%' . $word . '%');
    //         }
    //     })
    //     ->whereNotNull('lat')
    //     ->WhereNotNull('lon')->get();
    //     // dd($locationResults);
    //     return $locationResults;
    // }

    public static function getSearchedLocations(Request $request){
        $words = explode(' ', $request->search);
        $dealResults = Deal::orderBy('id', 'asc')
        ->where(function ($q) use ($words) {
            foreach ($words as $word) {
                $q->orWhere('name', 'like', '%' . $word . '%')
                ->orWhere('location', 'like', '%' . $word . '%')
                ->orWhere('category', 'like', '%' . $word . '%');
            }
        })->get();

        $locationResults = Location::orderBy('id', 'asc')
        ->where(function ($q) use ($dealResults) {
            foreach ($dealResults as $dealResult) {
                $q->orWhere('id', $dealResult->location_id);
            }
        })
        ->orWhere(function ($q) use ($words) {
            foreach ($words as $word) {
                $q->orWhere('name', 'like', '%' . $word . '%')
                ->orWhere('type', 'like', '%' . $word . '%');
            }
        })
        ->whereNotNull('lat')
        ->WhereNotNull('lon')->get();
        // dd($locationResults);
        return $locationResults;
    }

    // LOCATIONS FOR VIEW ALL CATEGORY MAP
    public static function getMatchingLocations($type){
        $dealResults = Deal::orderBy('id', 'asc')
        ->where('name', 'like', '%' . $type . '%')
                ->orWhere('location', 'like', '%' . $type . '%')
                ->orWhere('category', 'like', '%' . $type . '%')->get();

        $locationResults = Location::orderBy('id', 'asc')
        ->where(function ($q) use ($dealResults) {
            foreach ($dealResults as $dealResult) {
                $q->orWhere('id', $dealResult->location_id);
            }
        })
        ->orWhere('name', 'like', '%' . $type . '%')
        ->orWhere('type', 'like', '%' . $type . '%')
        ->whereNotNull('lat')
        ->WhereNotNull('lon')->get();
        // $locationResults =  Location::orderBy('id', 'asc')
        // ->where('name', 'like', '%' . $type . '%')
        // ->orWhere('location', 'like', '%' . $type . '%')
        // ->orWhere('type', 'like', '%' . $type . '%')
        // ->whereNotNull('lat')
        // ->WhereNotNull('lon')->get();
        // dd($locationResults);
        return $locationResults;
    }
    
    // public function deals(){
    //     return $this->hasMany(Deal::class);
    // }
}
