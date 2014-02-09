<!doctype html>
<html lang="en" ng-app="myApp">
<head>
  <meta charset="UTF-8">
  <title>Document</title>

  {{ HTML::style('assets/css/bootstrap.min.css') }}
</head>
<body>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        @yield('content')
      </div>
    </div>
  </div>
  @section('scripts')
  <script type="text/javascript" src="{{ asset('assets/js/angular.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/app.js') }}"></script>
</body>
</html>