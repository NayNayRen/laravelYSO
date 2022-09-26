<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class UserCoupon extends Model
{
    use HasFactory;

    // GET USERS COUPONS
    public static function getUserCoupons(){
        if ((auth()->user())){
            $user_id = (auth()->user()->id);               
            $cous = UserCoupon::where('user_id',$user_id)->get();
            $coupons =  Deal ::query();
            if($cous->count() > 0 ){
                foreach($cous as $cou){
                    if($coupons == null){
                        $coupons->where('id',$cou->deal_id);
                    }else{
                        $coupons->orwhere('id',$cou->deal_id);
                    }
                }
                $coupons = $coupons->get();
            }else{
                $coupons = null;
            }
        }else{
            $coupons = null;
        }
        return $coupons;
    }

    // GET USERS REDEEMED COUPONS
    public static function getUserRedeemedCoupons(){
        if ((auth()->user())){
            $user_id = (auth()->user()->id);               
            $redms = UserCoupon::where('user_id',$user_id)->where('status',1)->get();
            $redeems =  Deal ::query();
            if($redms->count() > 0 ){
                foreach($redms as $redm){
                    if($redeems == null){
                        $redeems->where('id',$redm->deal_id);
                    }else{
                        $redeems->orwhere('id',$redm->deal_id);
                    }
                }
                $redeems = $redeems->get();
            }else{
                $redeems = null;
            }
        }else{
            $redeems = null;
        }
        return $redeems;
    }

    // ASSOCIATES USER TO COUPON
    public function Users()
    {
        return $this->belongsTo(User::class);
    }
}
