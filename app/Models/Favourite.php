<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Favourite extends Model
{
    use HasFactory;

    // GET USERS FAVORITES
    public static function getUserFavorites(){
        if ((auth()->user())){
            $user_id = (auth()->user()->id);               
            $favs = Favourite::where('user_id',$user_id)->get();
            $favorites =  Deal::query();
            if($favs->count() > 0 ){
                foreach($favs as $fav){
                    if($favorites == null){
                        $favorites->where('id',$fav->deal_id);
                    }else{
                        $favorites->orwhere('id',$fav->deal_id);
                    }
                }
                    $favorites = $favorites->get();
                }else{
                    $favorites = null;
                }
            }else{
                $favorites = null;
        }
        return $favorites;
    }

    // ASSOCIATE USERS AND THEIR FAVORITES
    public function Users()
    {
        return $this->belongsTo(User::class);
    }

}
