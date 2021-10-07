<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\Product\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return DataTables::of(Product::with('category')->get())
            ->addIndexColumn()
            ->addColumn('actions', function($row) {
                $btn = "<div class='btn-group'>
                <a href='javascript:void(0)' class='text-decoration-none btn btn-sm btn-outline-dark'
                onclick='c_edit(`#m_product`, `.product_form :input`, [`#m_product_title`, `Edit product`], [`.btn_add_product`, `.btn_update_product`],$row,{rname:`admin.product.create`, target:`#display_categories`})'> Edit</a>"; // param [modal ID, form ID, model instance]

                $btn .= " <a href='javascript:void(0)' class='text-decoration-none btn btn-sm btn-outline-dark ' 
                onclick='c_destroy($row->id,`admin.product.destroy`,`.product_dt`)'> Delete</a>
                </div>"; // crud destroy param [row or model ID, route name, datatableID]

                return $btn;
            })
            ->rawColumns(['actions'])
            ->make(true);
        }
        return view('admin.product.index');
    }

    public function create()
    {
        return $this->res(['results' => Category::all()]);
    }

    public function store(ProductRequest $request)
    {
        $product_data = $request->validated();

        Product::create($product_data);

        return $this->res(['message' => 'Product Added Successfully']);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product_data = $request->validated();

        
        $product->update($product_data);

        return $this->res(['message' => 'Product Updated Successfully']);

    }

    public function destroy(Product $product)
    {
        $product->delete();

        return $this->res(['message' => 'Product Deleted Successfully']);

    }
}
