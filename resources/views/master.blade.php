<html>
<head>
	<title>Library</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
	<style type="text/css">
		body{
			background: url("{asset{'#####'}}") no-repeat center fixed;
			background-size: 100% auto;
		}
		header{opacity: 0.7;}
		footer{background-color:#fff;opacity: 0.9; text-align: center;}
	</style>
	</head>
	<body>
		<header class="Jumbotron">
			<div class="container">
				<div class="col-md-10"></div>
				<h1>the bookstore</h1>
				<p>Reading agood book id like taking ajourney</p>
			</div>
			<div class="col-md-2">
				<a href="{{route('library.index')}}">Home</a><br/>
				@if(Auth::check())
				<a href="{{route('admin')}}">{{Auth::user()->name}}is Area</a><br/>
				<a href="{{route('logout')}}">logout</a>
				@else
				<a href="{{route('login')}}">login</a><br/>
				<a href="{{route('register')}}">register</a><br/>
				@endif
				Date:{{date('Y-m-d')}} <br/> Time:{{date('H:i:s')}}
				
			</div>
			</div>
		</header>
@if(Session::has('m'))
<div class="container">
	<?php $a=[]; $a=session()->pull('m');?>
	<div class="alert alert-{{$a[0]}}">
    {{$a[1]}}
		
	</div>
		
</div>
@endif
@yield('content')

				<footer class="container">
			&copy;All agood book is 
		</footer>
	</body>
</html>