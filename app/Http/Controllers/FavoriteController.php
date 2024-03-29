<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function favoriteDeal(Request $request)
    {
        // dd ($request->all());
        if (auth()->user()) {
            $user_id = auth()->user()->id;

            if ($request->ajax()) {

                $check = Favorite::where('deal_id', $request->id)->where('user_id', $user_id)->first();
                if ($check != null) {
                    $check->delete();
                    return response()->json([
                        'delete' => 'Removed from Favorites list!',
                        'request' => $request->all(),
                    ]);
                } else {
                    $new  = new Favorite;
                    $new->deal_id = $request->id;
                    $new->user_id = $user_id;
                    $new->save();
                    return response()->json([
                        'success' => 'Added to Favorites successfully!',
                        'request' => $request->all(),
                    ]);
                }
            }
        } else {
            return response()->json([
                'error' => 'Please login first!',
            ]);
        }
    }
}
