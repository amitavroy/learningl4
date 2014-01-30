@layout('html')

@section('content')
  @foreach ($blogs as $blog)
    <h1>{{ $blog['content']->nodeTitle }}</h1>

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
@stop