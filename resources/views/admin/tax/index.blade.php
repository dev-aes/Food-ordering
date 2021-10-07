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
                <div class="card-header text-center">Manage Tax
                    <i class="fas fa-plus-circle text-primary float-right fa-lg" role="button" onclick="toggle_modal('#m_tax', '.tax_form', ['#m_tax_title','Add Tax'], ['.btn_add_tax','.btn_update_tax'])"></i>
                </div>
                
                <div class="card-body">
                    {{--1st Row--}}
                    <div class="row py-5 px-3">
                        <div class="table-responsive">
                            <table class="table table-hover tax_dt">
                            <caption>List of Taxes</caption>
                                <thead>
                                    <tr>
                                        <th>Tax</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   {{--Display List of Taxes (Server-Side-Rendering)--}}
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
