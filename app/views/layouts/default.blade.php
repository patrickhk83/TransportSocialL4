<!DOCTYPE html>
<html lang=”en”>
  <head>
    <meta charset="UTF-8" />
    <title>
      Tutorial
    </title>
  </head>
  <body>
    @include("_partials.header")
    <div class="content">
      <div class="container">
        @yield("content")
     </div>
    </div>
    @include("_partials.footer")
  </body>
</html>