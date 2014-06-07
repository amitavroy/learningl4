@layout('html')

@section('pageHeadSection')
@parent
<title>Welcome to Learning Laravel 4 - Registration page</title>
@stop

@section('content')
<div class="row">
  <div class="col-md-12">
    <h1>Registration form</h1>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    {{ Form::open(array('url' => 'registration/save')) }}
    <div class="form-group">
      {{ Form::label('email', 'E-Mail Address') }}
      {{ Form::email('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => 'Enter your email address')) }}
      <span class="error-display">{{$errors->first('email')}}</span>
    </div>
    <div class="form-group">
      {{ Form::label('firstname', 'First name') }}
      {{ Form::text('firstname', Input::old('firstname'), array('class' => 'form-control', 'placeholder' => 'Enter your First name')) }}
      <span class="error-display">{{$errors->first('firstname')}}</span>
    </div>
    <div class="form-group">
      {{ Form::label('lastname', 'Last name') }}
      {{ Form::text('lastname', Input::old('lastname'), array('class' => 'form-control', 'placeholder' => 'Enter your Last name')) }}
      <span class="error-display">{{$errors->first('lastname')}}</span>
    </div>
    <div class="form-group">
      {{ Form::label('password', 'Password') }}
      {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Enter your password, min 6 characters')) }}
      <span class="error-display">{{$errors->first('password')}}</span>
    </div>
    <div class="form-group">
      {{ Form::label('cpassword', 'Confirm Password') }}
      {{ Form::password('cpassword', array('class' => 'form-control', 'placeholder' => 'Confirm your password')) }}
      <span class="error-display">{{$errors->first('cpassword')}}</span>
    </div>

    <input type="submit" name="save" value="Save" class="btn btn-success">
    {{ Form::token() }}
    {{ Form::close() }}
  </div>
</div>
@stop