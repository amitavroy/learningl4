<?php $user = Session::get('authUser');?>
<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse"
				data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			{{link_to('#', 'Learning Laravel 4', array('class' =>
			'navbar-brand'))}}
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse"
			id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="dropdown">{{link_to('#', 'Learning Laravel 4')}}</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown"><img
					src="{{$user['user_details']->oauth_picture}}"
					alt="{{$user['user_details']->oauth_name}}"
					class="img-circle show-profile" /></li>
				<li class="dropdown"><a href="#" class="dropdown-toggle"
					data-toggle="dropdown">{{$user['user_details']->oauth_name}} <b
						class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>{{ link_to('edit-profile', 'Edit Profile') }}</li>
						<li class="divider"></li>
						<li>{{ link_to('logout', 'Logout') }}</li>
					</ul></li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container-fluid -->
</nav>