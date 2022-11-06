window.addEventListener('removedFromCartSuccess', () => {
	Livewire.emit('cart-updated')
})

Livewire.on('removedFromCart',(product) => {
	Livewire.emit('removeFromCart',product);
})

window.addEventListener('payment_request', (event) => {
	alert(`Mpesa Payment Reqeust of amount ${event.detail.amount} made for phone ${event.detail.payment_phone}`);
	//Livewire.emit('newEvent');
});

window.addEventListener('paymentRequestSent', (event) => {
	$("#paymentModal").modal("show");
	function checkTransactionStatus(){
		Livewire.emitTo('order-payment','checkTransactionStatus', event.detail.checkout_request_id);
		console.log("Emitted");
	}

	//setInterval(checkTransactionStatus, 1000);
	setTimeout(checkTransactionStatus, 2000);
});

window.addEventListener('paymentSuccessful', ()=>{
	//$("#paymentModal").modal("hide");
	$("#paymentModal .modal-body")
	.addClass("alert alert-success")
	.html(`Payment Was successful`);
	// enable closing of the modal after request has failed.
	$("#paymentModal .modal-header button").removeClass("invisible");
	$("#paymentModal .modal-footer button").removeClass("invisible");
});

window.addEventListener('paymentFailed', (event) => {
	//$("#paymentModal").modal("hide");
	$("#paymentModal .modal-body")
	.addClass("alert alert-warning")
	.html(`Mpesa payment failed due to ${event.detail.ResultDesc} <hr> <p class="text-primary">Please Try Again!</p>`);

	// enable closing of the modal after request has failed.
	$("#paymentModal .modal-header button").removeClass("invisible");
	$("#paymentModal .modal-footer button").removeClass("invisible");
});

window.addEventListener('loadMoreProducts', (event)=>{
	console.log('something clear');
	alert('Something cool');
	var moreProductsRow = document.getElementById('moreProducts').innerHTML;
	moreProductsRow.append('<h1>Hello new world</h1>');
});