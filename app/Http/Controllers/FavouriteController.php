<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favourite;

class FavouriteController extends Controller
{
    public function favouriteDeal(Request $request)  
    {
        // dd ($request->all());
        if(auth()->user())
        {   
            $user_id = auth()->user()->id;
            
            if ($request->ajax()) {

                $check = Favourite::where('deal_id',$request->id)->where('user_id',$user_id)->first();
                if($check!=null)
                {
                    $check->delete();    
                    return response()->json([
                        'delete' =>'Removed form Favorite list!',
                    ]);
                }
                else
                {
                    $new  = new Favourite;
                    $new->deal_id = $request->id;
                    $new->user_id = $user_id;
                    $new->save();
                    return response()->json([
                        'success' =>'Added to Favorites successfully!',
                    ]);
                }
            }
        }
        else
        {
            return response()->json([
                'error' =>'Kindly login first!',
            ]);
        }
        
    }
}
