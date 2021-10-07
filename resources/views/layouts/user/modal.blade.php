@if (url()->current() === route('user.dashboard.index'))
    {{--Order Modal--}}
        <div class="modal fade" id="m_order" tabindex="-1">
            <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="m_order_title">My Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body" >
                    <div class="card">
                        <div class="card-body" id="my_order">
                            {{--Display Auth User Orders--}}

                          
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
     {{--End ORder Modal--}}
@endif