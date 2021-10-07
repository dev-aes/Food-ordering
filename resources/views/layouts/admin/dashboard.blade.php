@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
          @include('layouts.admin.sidebar')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header text-center">My Dashboard</div>
                <div class="card-body">
                    {{--1st Row--}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header">
                                    Total Category
                    
                                </div>
                                <div class="card-body">
                                    <h1 class="text-muted">{{ $total_category }}</h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header">
                                    Total Product
                                </div>
                                <div class="card-body">
                                    <h1 class="text-muted">{{ $total_product }}</h1>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header">
                                    Total Order
                                </div>
                                <div class="card-body">
                                    <h1 class="text-muted">{{ $total_order }}</h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header">
                                    Total User
                                </div>
                                <div class="card-body">
                                    <h1 class="text-muted">{{ $total_user }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--2nd Row--}}
                    <div class="row py-5 px-3">
                        <div class="table-responsive">
                            <table class="table table-hover user_order_dt">
                            <caption>List of User's Orders</caption>
                                <thead>
                                    <tr>
                                        <th>Transaction_no</th>
                                        <th>Order By</th>
                                        <th>Order</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $user_ordered )

                                        <tr>
                                            <td>{{ $user_ordered[0]->transaction_no}}</td>
                                            <td>{{ $user_ordered[0]->user->name}}</td>
                                            <td>{{ $user_ordered[0]->product->name}} ...</td>
                                            <td><a class="btn btn-sm btn-primary" href="javascript:void(0)" onclick="showOrder({{$user_ordered[0]->id}})">Show</a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>No Available Order</td>
                                        </tr>
                                    @endforelse
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
