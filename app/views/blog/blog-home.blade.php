@layout('html')

@section('pageHeadSection')
@parent
<title>Welcome to Learning Laravel 4 - Blog landing page</title>
@stop

@section('content')
  <div ng-controller="BlogController" class="col-md-8">
    
    @foreach ($blogs as $blog)
      <a href="{{ $blog['url_alias'] }}"><h1>{{ $blog['content']->nodeTitle }}</h1></a>

      <div class="content-container">
        {{ $blog['content']->nodeSummary }}
      </div>

      <div class="terms">
        <ul>
          @foreach ($blog['tags'] as $term)
            <li>{{ $term->termName }}</li>
          @endforeach
        </ul>
      </div>
    @endforeach
  </div>
@stop