@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            {{--Side Nav--}}
            @include('layouts.admin.sidebar')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header text-center">Manage Coupons
                    <i class="fas fa-plus-circle text-primary float-right fa-lg" role="button" onclick="toggle_modal('#m_coupon', '.coupon_form', ['#m_coupon_title','Add Coupon'], ['.btn_add_coupon','.btn_update_coupon'])"></i>
                </div>
                
                <div class="card-body">
                    {{--1st Row--}}
                    <div class="row py-5 px-3">
                        <div class="table-responsive">
                            <table class="table table-hover coupon_dt">
                            <caption>List of Coupons</caption>
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Discount</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   {{--Display List of Coupons (Server-Side-Rendering)--}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
