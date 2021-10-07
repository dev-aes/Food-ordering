<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tax;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class TaxController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return DataTables::of(Tax::all())
            ->addIndexColumn()
            ->addColumn('actions', function($row) {

                if(!$row->status == 1)
                {
                    $btn = "<div class='btn-group'>
                    <a href='javascript:void(0)' class='text-decoration-none btn btn-sm btn-outline-dark'
                    onclick='crud_activate_deactivate($row->id, `admin.tax.update` , `activate`, `.tax_dt`, `Activate this Tax`)'>Activate</a>"; // param [model ID, Route, DT, Confirmation Msg]

                            
                    $btn .= " <a href='javascript:void(0)' class='text-decoration-none btn btn-sm btn-outline-dark ' 
                    onclick='c_destroy($row->id,`admin.tax.destroy`,`.tax_dt`)'> Delete</a>
                    </div>"; // crud destroy param [row or model ID, route name, datatableID]
                    
                }
                else
                {
  
                    $btn = "<div class='btn-group'>
                    <a href='javascript:void(0)' class='text-decoration-none btn btn-sm btn-outline-dark'
                    onclick='crud_activate_deactivate($row->id, `admin.tax.update` , `deactivate`, `.tax_dt`, `Deactivate this Tax`)'>Deactivate</a>"; // param [model ID, Route, DT, Confirmation Msg]"

                }
                
            

                return $btn;
            })
            ->rawColumns(['actions'])
            ->make(true);
        }
        
        return view('admin.tax.index');
    }

    public function store(Request $request)
    {
        $tax_data = $request->validate(['tax' => 'required']);

        Tax::create($tax_data);

        return $this->res(['message' => 'Tax Added Successfully']);
    }

    public function update(Request $request, Tax $tax)
    {
        Tax::where('id', '!=', $tax->id)->update(['status' => 0]); // deactivate other taxes . 

        return $request->option == 'activate' ? $tax->update(['status' => 1]) 
                                               : $tax->update(['status' => 0]);
       
    }

    public function destroy(Tax $tax)
    {
        $tax->delete();

        return $this->res(['message' => 'Tax Deleted Successfully']);

    }

}
