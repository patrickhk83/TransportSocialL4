@section("header")
  <nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    {{ link_to_route('site.home', 'Transport Social', null, array('class' => 'navbar-brand')) }}
  </div>

  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
      <li>{{ link_to_route('flights.by_airport', 'By Airport') }}</li>
      <li>{{ link_to_route('flights.by_route', 'By Route') }}</li>
      <li>{{ link_to_route('flights.by_flight_num', 'By Flight') }}</li>
      @if(Sentry::check())
        <li>{{ link_to_route('user.flights', 'Save Flights', array(Sentry::getUser()->id)) }}</li>
        <li>{{ link_to_route('user.profile', 'My Profile', array(Sentry::getUser()->id)) }}</li>
        <li>{{ link_to_route('users.logout', 'Logout') }}</li>
      @else
        <li>{{ link_to_route('users.login', 'Login') }}</li>
      @endif
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>
@show