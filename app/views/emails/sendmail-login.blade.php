@layout('html')

@section('pageHeadSection')
@parent
<title>Welcome to Learning Laravel 4 - Send mail login page</title>
@stop

@section('content')
<div class="row">
  <div class="col-md-12"><h2>Login to send mail</h2></div>
</div>
<div class="row">
  <div class="col-md-8">
    {{Form::open(array('url' => 'send-mail/authenticate'))}}
    <div class="form-group">
      {{ Form::text('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => 'Enter your email address')) }}
      <span class="error-display">{{$errors->first('email')}}</span>
    </div>
    <div class="form-group">
      {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Enter your password')) }}
      <span class="error-display">{{$errors->first('email')}}</span>
    </div>
    <div class="form-group">
      <input type="text" id="subject" placeholder="Enter the subject of the email" class="form-control" name="subject" />
    </div>
    <input type="submit" name="login" value="Login" class="btn btn-success">
    {{Form::close()}}
  </div>
</div>
@stop