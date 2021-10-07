@if (url()->current() === route('admin.category.index'))
    {{--Category Modal--}}
        <div class="modal fade" id="m_category" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="m_category_title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form class="category_form" autocomplete="off">
                    <div class="form-group">
                        <label class="form-label"> Category </label>
                        <input type="text" class="form-control" name="name">
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary btn_add_category" onclick="c_store('.category_form','.category_dt', 'admin.category.store')">Submit</button>
                <button type="button" class="btn btn-success btn_update_category" onclick="c_update('.category_form','.category_dt', 'admin.category.update', event)">Update</button>
                </div>
            </form>
            </div>
            </div>
        </div>
     {{--End Category Modal--}}
@endif


@if (url()->current() === route('admin.tax.index'))
    {{--Tax Modal--}}
        <div class="modal fade" id="m_tax" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="m_tax_title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form class="tax_form" autocomplete="off">
                    <div class="form-group">
                        <label class="form-label"> Tax </label>
                        <input type="number" min="0" class="form-control" name="tax">
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary btn_add_tax" onclick="c_store('.tax_form','.tax_dt', 'admin.tax.store')">Submit</button>
                <button type="button" class="btn btn-success btn_update_tax" onclick="c_update('.tax_form','.tax_dt', 'admin.tax.update', event)">Update</button>
                </div>
            </form>
            </div>
            </div>
        </div>
     {{--End Tax Modal--}}
@endif



@if (url()->current() === route('admin.product.index'))
    {{--Product Modal--}}
        <div class="modal fade" id="m_product" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="m_product_title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form class="product_form" autocomplete="off">
                    <div class="form-group">
                        <label class="form-label"> Product Name </label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label class="form-label"> Select Category </label>
                        <select class="form-control" name="category_id" id="display_categories">
                            {{--Display Categories--}}
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label"> Price </label>
                        <input type="number" min="0" max="99" class="form-control" name="price">
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary btn_add_product" onclick="c_store('.product_form','.product_dt', 'admin.product.store')">Submit</button>
                <button type="button" class="btn btn-success btn_update_product" onclick="c_update('.product_form','.product_dt', 'admin.product.update', event)">Update</button>
                </div>
            </form>
            </div>
            </div>
        </div>
     {{--End Product Modal--}}
@endif


@if (url()->current() === route('admin.coupon.index'))
    {{--Coupon Modal--}}
        <div class="modal fade" id="m_coupon" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="m_coupon_title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form class="coupon_form" autocomplete="off">
                    <div class="form-group">
                        <label class="form-label"> Coupon </label>
                        <input type="text" class="form-control" name="code" oninput="this.value = this.value.toUpperCase();">
                    </div>
                    <div class="form-group">
                        <label class="form-label"> Discount </label>
                        <input type="number" class="form-control" name="discount">
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary btn_add_coupon" onclick="c_store('.coupon_form','.coupon_dt', 'admin.coupon.store')">Submit</button>
                <button type="button" class="btn btn-success btn_update_coupon" onclick="c_update('.coupon_form','.coupon_dt', 'admin.coupon.update', event)">Update</button>
                </div>
            </form>
            </div>
            </div>
        </div>
     {{--End Coupon Modal--}}
@endif

@if (url()->current() === route('admin.dashboard.index'))
    {{--Order Modal--}}
        <div class="modal fade" id="m_admin_order" tabindex="-1">
            <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="m_order_title">Order Summary</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body" >
                    <div class="card">
                        <div class="card-body" id="admin_my_order">
                            {{--Display  User Orders--}}

                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
     {{--End ORder Modal--}}
@endif