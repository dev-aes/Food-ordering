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
                <div class="card-header text-center">Manage Category
                    <i class="fas fa-plus-circle text-primary float-right fa-lg" role="button" onclick="toggle_modal('#m_category', '.category_form', ['#m_category_title','Add Category'], ['.btn_add_category','.btn_update_category'])"></i>
                </div>
                
                <div class="card-body">
                    {{--1st Row--}}
                    <div class="row py-5 px-3">
                        <div class="table-responsive">
                            <table class="table table-hover category_dt">
                            <caption>List of User's Orders</caption>
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   {{--Display List of Categories (Server-Side-Rendering)--}}
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
