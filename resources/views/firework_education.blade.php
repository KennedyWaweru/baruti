@extends('layouts.master')

@section('content')
<h1 class="text-center text-success fs-1">Firework Education Page</h1>
{{-- Use bootstrap accordions--}}
<div class="container my-2">
    <div class="accordion" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
          <h2 class="accordion-header fs-2" id="panelsStayOpen-headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
              Firework Safety
            </button>
          </h2>
          <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
            <div class="accordion-body fs-4">
              <strong>Proper safety measures needed when lighting off fireworks.</strong> From Fountains to Rockets, Sparklers to Repeaters, whatever your choice is, we want to make sure the proper safety measures are taken so you and your family can have a safe and fun time.
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header fs-2" id="panelsStayOpen-headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
              Rockets Safety
            </button>
          </h2>
          <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
            <div class="accordion-body fs-4">
              <h3 class="text-center fs-3 text-info">How to ignite a firework rocket</h3>
              <img class="img-fluid mx-auto" src="https://d34dnz415a0ab2.cloudfront.net/lighting-rocket.jpg" alt="How to light a Rocket" width="400" height="400">
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Make sure you have a clear, open space to light.</strong></li>
                <li class="list-group-item">After you light the fuse move a safe distance away</li>
                <li class="list-group-item">Make sure your audience is a safe distance away</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header fs-2" id="panelsStayOpen-headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
              Aerial Repeater/ Cake Safety
            </button>
          </h2>
          <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
            <div class="accordion-body fs-4">
              <h3 class="text-center fs-3 text-info">How to ignite an aerial repeater</h3>
              <img class="img-fluid mx-auto" src="https://d34dnz415a0ab2.cloudfront.net/ignite-cake-fuse.jpg" alt="How to light a Rocket" width="400" height="400">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <strong>Set up your repeaters on a hard flat, level surface.</strong>
                </li>
                <li class="list-group-item">
                  Make sure you have a clear, open space to shoot with 150 feet distance between your launch site and the audience
                </li>
                <li class="list-group-item">
                  After you light the fuse move a minimum of 20 feet from the repeater.
                </li>  
              </ul>
            </div>
          </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header fs-2" id="panelsStayOpen-headingFour">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                Fountains Safety
              </button>
            </h2>
            <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingFour">
              <div class="accordion-body fs-4">
              <h3 class="text-center fs-3 text-info">How to ignite a firework fountain</h3>
              <img class="img-fluid mx-auto" src="https://d34dnz415a0ab2.cloudfront.net/fountain-fuse-nozzle.png" alt="How to light a fountain firework" width="400" height="400">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  {{-- TODO --}}
                </li>
                <li class="list-group-item">
                  {{-- TODO --}}
                </li>
                <li class="list-group-item">
                  {{-- TODO --}}
                </li>  
              </ul>
              </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header fs-2" id="panelsStayOpen-headingFive">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
                Sparklers Safety
              </button>
            </h2>
            <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingFive">
              <div class="accordion-body fs-4">
                <h3 class="text-center fs-3 text-info">How to ignite a Sparkler</h3>
              <img class="img-fluid mx-auto" src="https://d34dnz415a0ab2.cloudfront.net/lighting-sparklers.jpg" alt="How to light a Sparkler">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  {{-- TODO --}}
                </li>
                <li class="list-group-item">
                  {{-- TODO --}}
                </li>
                <li class="list-group-item">
                  {{-- TODO --}}
                </li>  
              </ul>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header fs-2" id="panelsStayOpen-headingSix">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="false" aria-controls="panelsStayOpen-collapseSix">
                Roman Candle Safety
              </button>
            </h2>
            <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingSix">
              <div class="accordion-body fs-4">
              <h3 class="text-center fs-3 text-info">How to ignite a Roman Candle</h3>
              <div class="row">
                <div class="col-md-6">
                  <img class="img-fluid mx-auto" src="https://d34dnz415a0ab2.cloudfront.net/ignite-candle.jpg" alt="How to light a Roman Candle">
                </div>
                <div class="col-md-6">
                  <img class="img-fluid mx-auto" src="https://d34dnz415a0ab2.cloudfront.net/lighting-up-roman-candles.jpg" alt="How to handle a lit Roman Candle">
                </div>
              </div>
              
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  {{-- TODO --}}
                </li>
                <li class="list-group-item">
                  {{-- TODO --}}
                </li>
                <li class="list-group-item">
                  {{-- TODO --}}
                </li>  
              </ul>
              </div>
            </div>
          </div>
      </div>
</div>
@endsection