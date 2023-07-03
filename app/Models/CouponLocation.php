<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponLocation extends Model
{
    use HasFactory;
    //  needed to continue using capitalized table name
    protected $table = 'deal_locations';

    public static function getCouponLocations()
    {
        $couponLocationIds = CouponLocation::get();
        return $couponLocationIds;
    }
}
