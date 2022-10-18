@extends('layouts.master')

@section('styles')
<style>
	
</style>

@endsection
@section('content')
<div class="container">
	<div class="row  bg-secondary p-5">
		<div class="col-md-7 bg-light p-3">
			<div class="row my-3">
				<div class="tl-container">
					<ul class="timeline">
						<li class="active-tl">
							Delivery

						</li>
						<li>
							Payment

						</li>
						<li>
							Confirmation

						</li>
					</ul>
				</div>
			</div>
			@livewire('order')
		</div>
		 <div class="col-md-5 col-sm-12 bg-success text-white p-3">
		 	@livewire('cart-summary')
	 	</div>
	</div>
</div>
@endsection

@section('bottom_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&libraries=places" ></script>
<script>

<script>
        $(document).ready(function () {
            $("#latitudeArea").addClass("d-none");
            $("#longtitudeArea").addClass("d-none");
        });
 </script>

<script>
        google.maps.event.addDomListener(window, 'load', initialize);
  
        function initialize() {
            var input = document.getElementById('autocomplete');
            var autocomplete = new google.maps.places.Autocomplete(input);

			autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
                $('#latitude').val(place.geometry['location'].lat());
                $('#longitude').val(place.geometry['location'].lng());
                $("#latitudeArea").removeClass("d-none");
                $("#longtitudeArea").removeClass("d-none");
            });
        }
</script>
@endsection