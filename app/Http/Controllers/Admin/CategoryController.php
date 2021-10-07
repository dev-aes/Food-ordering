<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return DataTables::of(Category::all())
            ->addIndexColumn()
            ->addColumn('actions', function($row) {
                $btn = "<div class='btn-group'>
                <a href='javascript:void(0)' class='text-decoration-none btn btn-sm btn-outline-dark'
                onclick='c_edit(`#m_category`, `.category_form :input`, [`#m_category_title`, `Edit Category`], [`.btn_add_category`, `.btn_update_category`], $row)'> Edit</a>"; // param [modal ID, form ID, model instance]

                $btn .= " <a href='javascript:void(0)' class='text-decoration-none btn btn-sm btn-outline-dark ' 
                onclick='c_destroy($row->id,`admin.category.destroy`,`.category_dt`)'> Delete</a>
                </div>"; // crud destroy param [row or model ID, route name, datatableID]

                return $btn;
            })
            ->rawColumns(['actions'])
            ->make(true);
        }
        return view('admin.category.index');
    }

    public function store(Request $request)
    {
        $category_data = $request->validate(['name' => 'required|unique:categories']);

        Category::create($category_data);

        return $this->res(['message' => 'Category Added Successfully']);
    }

    public function update(Request $request, Category $category)
    {
        $category_data = $request->validate(['name' => 'required']);
        
        $category->update($category_data);

        return $this->res(['message' => 'Category Updated Successfully']);

    }

    public function destroy(Category $category)
    {
        $category->delete();

        return $this->res(['message' => 'Category Deleted Successfully']);

    }
}
