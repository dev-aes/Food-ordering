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
                <div class="card-header text-center">Manage Products
                    <i class="fas fa-plus-circle text-primary float-right fa-lg" role="button" onclick="toggle_modal('#m_product', '.product_form', ['#m_product_title','Add Product'], ['.btn_add_product','.btn_update_product'], {rname:'admin.product.create', target:'#display_categories'})"></i>
                </div>
                
                <div class="card-body">
                    {{--1st Row--}}
                    <div class="row py-5 px-3">
                        <div class="table-responsive">
                            <table class="table table-hover product_dt">
                            <caption>List of Available Food Products</caption>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Date Added</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   {{--Display List of Products (Server-Side-Rendering)--}}
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
