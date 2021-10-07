<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function __invoke(Order $order)
    {
        $myorders = Order::with('product.category', 'tax', 'coupon')
                          ->where('transaction_no', $order->transaction_no)
                          ->get();

        return $this->res(['results' => $myorders]);
    }

}
