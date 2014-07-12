@layout('html')

@section('content')
<h1>You have logged in using Google O Auth</h1>
<p>Welcome to this demo. You are logged in as <strong>{{$user['user_details']->oauth_name}}</strong></p>
<img src="{{$user['user_details']->oauth_picture}}" alt="{{$user['user_details']->oauth_name}}" class="img-circle" width="200" height="200" />

@stop

@section('pageHeadSection')
@parent
<title>Login using O Auth and Sentry</title>
@stop