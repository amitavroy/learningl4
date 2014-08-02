@section('content')
    <h2>Blog listing</h2>
    
    @foreach ($blogposts as $blogpost)
        @include('blogger::blog-teaser', array('blogpost' => $blogpost))
    @endforeach
@stop