<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponLocation extends Model
{
    use HasFactory;
    //  needed to continue using capitalized table name
    // not a proper naming convention
    protected $table = 'CouponLocations';

    public static function getCouponLocations()
    {
        $couponLocationIds = CouponLocation::get();
        return $couponLocationIds;
    }
}
