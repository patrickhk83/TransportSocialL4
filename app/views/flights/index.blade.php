@extends('layouts.default')
@section('content')
  @if(count($flights) > 0)
    <div class="list-group">
    @foreach($flights as $flight)
      <li class="list-group-item">
        <div class="flightNumber">
          {{ $flight->carrier->fs }}
          {{ $flight->flightNumber }}
        </div>
        <div class="carrier">
          {{ $flight->carrier->name }}
        </div>
        <div class="route">
          {{ $flight->arrivalAirport->name.' to '.$flight->departureAirport->name }}
        </div>

        <div class="times">
          <p>Departure Time: {{ date('d/m/Y h:m', strtotime($flight->departureDate->dateLocal)) }}</p>
          <p>Arrival Time: {{ date('d/m/Y h:m', strtotime($flight->arrivalDate->dateLocal)) }}</p>
        </div>

        @if($flight->totalPassengers > 0)
          <p>
            @foreach($flight->totalPassengers as $passenger)
              <img src="/assets/images/default-profile-pic.png" width="20" height="20">
            @endforeach
          </p>
        @endif

        @if(!Auth::guest())
          <div>
            @if(!$flight->is_saved)
              {{ link_to_route('flight.privacy', 'Save', array($flight->flightId), array('class' => 'btn btn-primary')) }}
            <?php else: ?>
              {{ link_to_route('flight.delete', 'Delete', array($flight->flightId), array('class' => 'btn btn-primary')) }}
            @endif
          </div>
        @endif
      </li>
    @endforeach
    </div>
  @else
    <p>Sorry, it appears that no flights were found!</p>
  @endif
@stop