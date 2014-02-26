<!doctype html>
<html lang="en" ng-app="myApp">
<head>
  <meta charset="UTF-8">
  @section('pageHeadSection')
  {{ HTML::style('assets/css/bootstrap.min.css') }}
  @show
</head>
<body>

  <div class="container">
    <div class="row">
      <div class="col-md-8">
        @yield('content')
      </div>

      <div class="col-md-4">
        <h2>Latest Articles</h2>
        
      </div>
    </div>
  </div>

  @section('scripts')
    <script type="text/javascript" src="{{ asset('assets/js/angular.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/shCore.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/shBrushPhp.js') }}"></script>
  @show
  
</body>
</html>