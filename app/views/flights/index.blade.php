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
              <a href="/auth/edit_user/{{ $passenger->id }}" data-toggle="tooltip" title="{{ $passenger->username }}">
                <img src="/assets/images/default-profile-pic.png" width="20" height="20">
              </a>
            @endforeach
          </p>
        @endif

        @if(isset($user))
          <div>
            @if(!$flight->isSaved)
              <a class="btn btn-primary" href="/flight/setPrivacy/{{ $flight->flightId }}">Save</a>
            <?php else: ?>
              <a class="btn btn-primary" href="/flight/deleteFlight/{{ $flight->flightId }}">Delete</a>
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