<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            $orders = Order::with('product')->where('user_id', auth()->id())->get();

            return DataTables::of($orders)
            ->addIndexColumn()
            ->addColumn('actions', function($row) {
                $btn = "<div class='btn-group'>
                <a href='javascript:void(0)' class='text-decoration-none btn btn-sm btn-primary text-white'
                onclick='showOrder($row->id)'> View</a>"; // model-id
                return $btn;
            })
            ->rawColumns(['actions'])
            ->make(true);
        }

        return view('layouts.user.dashboard');
    }
}
