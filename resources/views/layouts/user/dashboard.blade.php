@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
          @include('layouts.user.sidebar')
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center">My Dashboard</div>
                <div class="card-body">
                    {{--1nd Row--}}
                    <div class="row py-5 px-3">
                        <div class="table-responsive">
                            <table class="table table-hover order_dt">
                            <caption>My Recent Order</caption>
                                <thead>
                                    <tr>
                                        <th>Order</th>
                                        <th>Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{--Display My Orders--}}
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
