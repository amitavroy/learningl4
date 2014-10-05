@section('content')
<div class="login-page login-container row">

    <div class="col-md-4 col-md-push-3">
        
        <h1>Login</h1>

        {{Form::open(array('url' => 'user/login'))}}
        
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="username">
        </div>
        
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
        </div>
        
        <button type="submit" class="btn btn-default">Login</button>
        
        {{Form::close()}}

    </div>

</div>
@stop