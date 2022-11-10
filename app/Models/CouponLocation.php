<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponLocation extends Model
{
    use HasFactory;

    public static function getCouponLocations(){
        $couponLocationIds = CouponLocation::get();
        return $couponLocationIds;
    }
}
