<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ asset('css/backend/zcamp.css')}}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="page">
<div class="col-md-2 sidebar pad-0">
<div>
	<div class="logo">
		<a href="{{ url('/') }}">ZCAMP</a>
	</div>
	<ul class="menu">
		<li class="sub-menu"><a href="{{ url('admin') }}"><i class="fa fa-th"></i><span>Dashboard</span></a></li>
		<li class="sub-menu"><a href="#"><i class="fa fa-user"></i><span>Profile</span></a></li>
		<li class="sub-menu"><a href="#"><i class="fa fa-users"></i><span>Users</span></a></li>
		<li class="sub-menu"><a href="{{ url('projects') }}"><i class="fa fa-folder"></i><span>Projects</span></a></li>
		<li class="sub-menu"><a href="{{ url('task') }}"><i class="fa fa-comments"></i><span>Tasks</span></a></li>
		<li class="sub-menu"><a href="{{ url('adminlogout') }}"><i class="fa fa-sign-out"></i><span>Log Out</span></a></li>
	</ul>
</div>
</div>
<div class="col-md-10 main-content">
	<div class="row header">
		<div class="col-md-8">
			@if(Auth::check())
				<p>Hello {{ Auth::user()->name }},</p>
			@else
				<p>Hello,</p>
			@endif
		</div>
		<div class="col-md-4">
			<form class="dashboard-search">
				<input type="text" name="search" placeholder="Search...">
				<input type="submit" value="Go">
			</form>
		</div>	
	</div>
	<hr>
	@yield('content')
</div>
</div>
</body>
</html>
