<div>
    {{-- Do your work, then step back. --}}
    @isset($package)
            <div class="table-responsive-sm cart-summary">
                <h3 class="text-center fs-4 text-primary p-2 bg-light">{{$package->name}}</h3>
                 <table class="table table-success table-striped table-hover">
                     <thead class="table-dark">
                         <tr>
                             <td>Item</td>
                             <td>Price</td>
                         </tr>
                     </thead>
                     <tbody>
                       
                        @foreach($package->fireworks as $order_firework)
                            <tr>
                                <td>{{$order_firework->name}}</td>
                                <td>{{$order_firework->price}}</td>
                            </tr>
						@endforeach
                       
                         <tfoot>
                             @if((int)$package->price < 1000)
                             <tr class="fw-bold">
                                 <td>Delivery Fee</td>
                                 <td>
                                     500
                                    
                                </td>
                             </tr>
                             <tr class="fw-bold">
                                 <td>Total</td>
                                 <td>
                                    {{number_format($package->price)}}
                                </td>
                             </tr>
                             <div class="alert alert-warning fs-6" role="alert">
                                 Orders below Kshs 2,000 will incur an extra Kshs 500 Delivery Fee!
                           </div>
                             @else
                             <tr class="fw-bold">
                                 <td>Total</td>
                                 <td>
                                    {{number_format($package->price)}}
                                </td>
                             </tr>
                            @endif
                        </tfoot>
                     </tbody>
     
                </table>
            </div> 
            @endisset
</div>
