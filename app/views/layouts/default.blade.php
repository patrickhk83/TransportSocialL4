<!DOCTYPE html>
<html lang=”en”>
  <head>
    {{ HTML::style("//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css") }}
    {{ HTML::style("//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css") }}

    {{ HTML::script("//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js") }}
    <meta charset="UTF-8" />
    <title>
      Tutorial
    </title>
  </head>
  <body>
    <div class="container">
      @include("_partials.header")
      <div class="main">
        <div class="panel panel-default">
          <div class="content panel-body">
            @yield("content")
          </div>
        </div>
      </div>
      @include("_partials.footer")
    </div>
  </body>
</html>