<div class="table-delivery-info">
    <div class="row">
        <h2 class="text-center">Your Details</h2>
        <div class="table-responsive">
            <table class="table table-striped">
             <thead class="table-info">
                 <th>Field</th>
                 <th>Input</th>
             </thead>
             <tbody>

                 @isset($form_details)
                    <tr>
                        <td>Name</td>
                        <td>{{$form_details['first_name'].'   '.$form_details['second_name']}}</td>
                    </tr>
                    <tr>
                        <td>Contact Phone</td>
                        <td>{{$form_details['phone']}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{$form_details['email']}}</td>
                    </tr>
                    <tr>
                        <td>Location</td>
                        <td>{{$form_details['location']}}</td>
                    </tr>
                    <tr>
                        <td>Delivery Day</td>
                        <td>@if($form_details['delivery_day'] == 1) Today @else Tomorrow @endif</td>
                    </tr>
                 @endisset
             </tbody>
         </table>
     </div>
 </div>
 <div class="row">
        <strong class="text-center my-2">Mpesa Express</strong>
        <input type="text" pattern="[0-9]{10}$" class="form-control my-2"  value="{{$form_details['phone']}}" wire:model.defer="payment_phone"  name="payment_phone">
        <button wire:click="sendPaymentRequest" wire:loading.remove class="btn btn-outline-success">Send Request to Phone</button>
 </div> 
 @include('partials.payment-modal')         
</div>
