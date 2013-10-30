@extends('layouts.default')
@section('content')
  @include('_partials.errors')
  {{ Form::open(array('action' => 'FlightsController@by_route'))}}
    <div class="form-group">
      <label for="arrivalAirportCode">Arrival Airport</label>
  		{{ Form::text('arrivalAirportCode', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
      <label for="departureAirportCode">Departure Airport</label>
      {{ Form::text('departureAirportCode', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
      <label for="Date">Date</label>
      <div class="input-group date"  data-date-format="d-m-yyyy">
        {{ Form::text('date', date('j-n-Y'), array('class' => 'form-control')) }}
        <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
      </div>
    </div>
    <div class="form-group">
      {{ Form::submit('Search', array('class' => 'btn btn-primary')) }}
    </div>
  {{ Form::close() }}
@stop