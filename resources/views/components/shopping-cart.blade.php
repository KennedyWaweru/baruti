<!-- Show shopping cart in a modal -->
<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" wire:ignore.self id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header w-100">
        <div class="container-fluid">
          <div class="row text-center">
              <div class="col">
                <h5 class="modal-title" id="cartModalLabel">My Cart</h5>
            </div>
            <div class="col">
              <h5 class="modal-title">{{$cart_count}} Items &nbsp; &nbsp; Total: {{$total}}</h5>
          </div>
      </div>

  </div>

  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<table class="table table-striped table-hover align-middle">
      <thead>
        <th>Product Details</th>
        <th>Quantity</th>
        <th>Unit Price</th>
        <th>Sub-total</th>
        <th></th>
    </thead>
    <tbody>

    {{$slot}}

    </tbody>
</table>
</div>
<div class="modal-footer">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <button type="button" class="btn btn-secondary float-start" data-bs-dismiss="modal">Continue Shopping</button>
      </div>
      <div class="col">
          <a role="button" href="{{route('order')}}" class="btn btn-outline-primary btn-lg float-end">Buy</a>
      </div>
  </div>
</div>

</div>
</div>
</div>
</div>