<!doctype html>
<html lang="en" ng-app="myApp">
<head>
  <meta charset="UTF-8">
  @section('pageHeadSection')
  {{ HTML::style('assets/css/bootstrap.min.css') }}
  {{ HTML::style('assets/css/custom.css') }}
  @show
</head>
<body>
  @if (isset($menu) && $menu == true)
  @include('nav')
  @endif
  <div class="container">
    @if (Session::get('message'))
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-{{ Session::get('message-flag') }}">{{ Session::get('message') }}</div>
      </div>
    </div>
    @endif
    <div class="row">
      <div class="col-md-8">
        @yield('content')
      </div>

      @if (isset($sidebar) && !$sidebar == false)
      <div class="col-md-4" ng-controller="SidebarController">
        <h2>Latest Articles</h2>
        <ul>
          <li ng-repeat="article in sideBarArticles">{[article.name]}</li>
        </ul>
      </div>
      @endif
    </div>
  </div>

  @section('scripts')
    @if (Config::get('app.development') == 'true')
    <script type="text/javascript" src="{{ asset('assets/js/jquery-1.11.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
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