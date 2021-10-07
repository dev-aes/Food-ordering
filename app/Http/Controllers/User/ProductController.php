<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function __invoke(Product $product)
    {
        return $this->res(['result' => $product]);
    }
}
