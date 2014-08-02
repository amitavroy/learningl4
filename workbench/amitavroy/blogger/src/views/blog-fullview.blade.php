@section('content')
<div class="blog-post" id="blog-{{$blogpost->blog_id}}">
	<h1 class="title">{{$blogpost->blog_title}}</h1>
	
	<div class="meta">
		<p>
			<span class="posted-on">Posted on {{$blogpost->created_at}}</span>, <span
				class="comment-num">Comments: {{$blogpost->num_of_comments}}</span>
		</p>
	</div>
	
	<div class="content summary">
	   {{$blogpost->blog_body}}
  </div>
</div>
@stop