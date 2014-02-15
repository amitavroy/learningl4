@layout('html')

@section('content')
<?php //echo '<pre>' . print_r($post, true) . '</pre>'; ?>
<h1 class="post-title">
  {{ $post['content']->nodeTitle }}
</h1>

<div class="post content content-wrapper">
  <div class="body">
    {{ $post['content']->nodeBody }}
  </div>
</div>
@stop

@section('pageHeadSection')
@parent
<title>{{ $post['content']->nodeTitle }}</title>
@stop