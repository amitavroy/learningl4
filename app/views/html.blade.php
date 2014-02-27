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

      <div class="col-md-4" ng-controller="SidebarController">
        <h2>Latest Articles</h2>
        <ul>
          <li ng-repeat="article in sideBarArticles">{[article.name]}</li>
        </ul>
      </div>
    </div>
  </div>

  @section('scripts')
    @if (Config::get('app.development') == 'true')
    <script type="text/javascript" src="{{ asset('assets/js/angular.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/dev/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/dev/sidebar.js') }}"></script>
    @else
    <script type="text/javascript" src="{{ asset('assets/js/angular.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/prod/home.js') }}"></script>
    @endif
  @show
  
</body>
</html>