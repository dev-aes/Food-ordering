<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class CouponController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return DataTables::of(Coupon::all())
            ->addIndexColumn()
            ->addColumn('actions', function($row) {

                if(!$row->status == 1)
                {
                    $btn = "<div class='btn-group'>
                    <a href='javascript:void(0)' class='text-decoration-none btn btn-sm btn-outline-dark'
                    onclick='crud_activate_deactivate($row->id, `admin.coupon.update` , `activate`, `.coupon_dt`, `Activate this coupon`)'>Activate</a>"; // param [model ID, Route, DT, Confirmation Msg]

                            
                    $btn .= " <a href='javascript:void(0)' class='text-decoration-none btn btn-sm btn-outline-dark ' 
                    onclick='c_destroy($row->id,`admin.coupon.destroy`,`.coupon_dt`)'> Delete</a>
                    </div>"; // crud destroy param [row or model ID, route name, datatableID]
                    
                }
                else
                {
  
                    $btn = "<div class='btn-group'>
                    <a href='javascript:void(0)' class='text-decoration-none btn btn-sm btn-outline-dark'
                    onclick='crud_activate_deactivate($row->id, `admin.coupon.update` , `deactivate`, `.coupon_dt`, `Deactivate this coupon`)'>Deactivate</a>"; // param [model ID, Route, DT, Confirmation Msg]"

                }
                
            

                return $btn;
            })
            ->rawColumns(['actions'])
            ->make(true);
        }

        return view('admin.coupon.index');
    }
    public function store(Request $request)
    {
        
        $coupon_data = $request->validate(['code' => 'required|unique:coupons|min:5|max:12', 'discount' => 'required']);

        $coupon_data['code'] = str_replace(' ', '', $coupon_data['code']);

        Coupon::create($coupon_data);

        return $this->res(['message' => 'Coupon Code Added Successfully']);
    }

    public function update(Request $request, Coupon $coupon)
    {
        return $request->option == 'activate' ? $coupon->update(['status' => 1]) 
                                               : $coupon->update(['status' => 0]);
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return $this->res(['message' => 'Coupon Code Deleted Successfully']);
    }
}
