<?php

namespace App\Http\Controllers\User;

use App\Models\Tax;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Oder\OrderRequest;

class OrderController extends Controller
{
    
    public function index()
    {
        $quotes = [
            'First, we eat. Then, we do everything else 🍔',
            'Live, love, eat 🌮.',
            'Made with love 🥙.',
            'Hunger is a good cook 🍔.',
            'Grill and chill! 🍖.',
            'What diet? 🍳.',
            'Eat today, live another day 🍕.',
        ];

        $quote = Arr::random($quotes);

        $coupons = Coupon::where('status', 1)->get();


        return view('user.order.index', ['categories' => Category::all(), 'quote' => $quote, 'coupons' => $coupons]);
    }

   
    public function create()
    {
        $results = [
            'categories' => Product::where('category_id', request('category'))->get() ,
            'tax' => Tax::where('status', 1)->first()
        ];

        return $this->res(['results' => $results ]);
    }

   
    public function store(OrderRequest $request)
    {
       
       $order_data = $request->validated();

       $order_data['user_id'] = auth()->id(); // authenticated user / 
       $order_data['transaction_no'] =  mt_rand(123456,999999);


       foreach($order_data['product_id'] as $product) // multiple orders
       {
            $order_data['product_id'] = $product;

            Order::create($order_data);
       }


       return back()->with('success' , 'Ordered Successfully !');

    }

    
    public function show(Order $order)
    {
        $myorders = Order::with('product.category', 'tax', 'coupon')
                          ->where('transaction_no', $order->transaction_no)
                          ->where('user_id', auth()->id())
                          ->get();

        return $this->res(['results' => $myorders]);
    }

   
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

}
