@extends('layouts.default')
@section('content')
  <div class="flightNumber">
    {{ $flight->carrier->iata }}
    {{ $flight->flightNumber }}
  </div>
  <div class="carrier">
    {{ $flight->carrier->name }}
  </div>
  <div class="route">
    {{ $flight->arrivalAirport->name.' to '.$flight->departureAirport->name }}
  </div>

  <div class="times">
    <p>Departure Time: {{ date('d/m/Y h:m', strtotime($flight->departureDate)) }}</p>
    <p>Arrival Time: {{ date('d/m/Y h:m', strtotime($flight->arrivalDate)) }}</p>
  </div>

  @if(count($flight->passengers) > 0)
    <p>
      @foreach($flight->passengers as $passenger)
        <img src="/images/default-profile-pic.png" width="20" height="20">
      @endforeach
    </p>
  @endif

  @if(Sentry::check())
    @if(!$flight->saved)
      {{ link_to_route('flight.privacy', 'Save', array($flight->id), array('class' => 'btn btn-primary')) }}
    @else
      {{ link_to_route('flight.delete', 'Delete', array($flight->id), array('class' => 'btn btn-primary')) }}
    @endif
  @endif
@stop