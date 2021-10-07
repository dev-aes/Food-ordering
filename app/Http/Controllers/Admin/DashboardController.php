<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\UserOrderResource;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::with('product', 'user')->get()->groupBy('transaction_no');


        $total_category = Category::count();
        $total_product = Product::count();
        $total_order = Order::all()->groupBy('transaction_no')->count();
        $total_user = User::where('role_id', '!=', 1)->count();
      
        return view('layouts.admin.dashboard', compact('total_category', 'total_product', 'total_order', 'total_user', 'orders'));
    }
}
