<div class="blog-post" id="blog-{{$blogpost->blog_id}}">
	<h1 class="title">
		<a href="{{url('blog/view/1')}}">{{$blogpost->blog_title}}</a>
	</h1>

	<div class="meta">
		<p>
			<span class="posted-on">Posted on {{$blogpost->created_at}}</span>, <span
				class="comment-num">Comments: {{$blogpost->num_of_comments}}</span>
		</p>
	</div>

	<div class="content summary">{{$blogpost->blog_summary}}</div>

	<div class="read-more">{{link_to('blog/view/' . $blogpost->blog_id,
		'Read more >>>')}}</div>
</div>