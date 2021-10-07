<?php

namespace App\Http\Controllers\User;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function __invoke()
    {   
        $get_coupon = Coupon::where('code', request('code'))
                             ->where('status', 1)
                             ->first();
        if($get_coupon) {

            return $this->res(['result' => $get_coupon]);
        }

        return $this->error('Invalid Coupon Code', 404);
        
    }
}
