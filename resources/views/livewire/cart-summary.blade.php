<div>
    {{-- <div class="col-md-5 col-sm-12 bg-success text-white p-3"> --}}
        <h3 class="text-center py-3">Cart Summary</h3>
        @isset($cart_content)
        <div class="table-responsive-sm cart-summary">
            <table class="table table-success table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <td>Item</td>
                        <td>Price</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart_content as $cart_item)
                    <tr>
                        <td>
                            {{$cart_item->name}} &times; {{$cart_item->qty}}
                        </td>
                        <td>
                            {{$cart_item->price}}
                        </td>
                    </tr>
                    @endforeach
                    <tfoot>
                        @if($cart_total < 1000)
                        <tr class="fw-bold">
                            <td>Delivery Fee</td>
                            <td>
                                500
                               {{-- {{$cart_total}} --}}
                           </td>
                        </tr>
                        <tr class="fw-bold">
                            <td>Total</td>
                            <td>
                               {{$cart_total}}
                           </td>
                        </tr>
                        <div class="alert alert-warning fs-6" role="alert">
                            Orders below Kshs 2,000 will incur an extra Kshs 500 Delivery Fee!
                      </div>
                        @else
                        <tr class="fw-bold">
                            <td>Total</td>
                            <td>
                               {{$cart_total}}
                           </td>
                        </tr>
                       @endif
                   </tfoot>
                </tbody>

           </table>
       </div>
       @endisset
     {{-- </div> --}}
</div>
