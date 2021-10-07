@extends('layouts.user.dashboard')



@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
            @include('layouts.user.sidebar')
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h5>{{ $quote }}</h5>
                </div>
                <div class="card-body">
                    <div class="row py-3 justify-content-center">
                        @if(session('success'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong> Thank you come again :)
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    
                        <form class="col-md-8" action="{{ route('user.order.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Select Menu</label>
                                <select class="form-control" onchange="getProduct(this)" required>
                                    <option ></option>
                                    @foreach ($categories as $category )
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Select Food</label>
                                <select class="form-control" name="product_id" id="d_product_list" onchange="selectProduct(this)" required>
                                    {{--Display Available Food Product By Category[id]--}}
                                </select>
                            </div>
                            <div id="d_selected_products">
                                {{--Display Selected Products--}}
                            </div>
                            <div id="d_billing">
                                {{--Display Billing--}}
                            </div>
                            <div id="d_inputs">
                                {{--Display Input Fields--}}
                            </div>

                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
          <div class="card">
              <div class="card-body">
                <p>Sample Coupons</p>
                  <ul>
                      @foreach ($coupons as $c )
                        <li class="text-dark font-weight-bold">{{ $c->code }}</li>
                      @endforeach
                  </ul>
              </div>
          </div>
        </div>
    </div>
</div>

@endsection

