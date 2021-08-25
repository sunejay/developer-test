<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>@yield('title')</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-danger bg-danger">
	    <div class="container">
		    <a class="navbar-brand text-light" href="#">iPS</a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
		        <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		        <div class="navbar-nav">
		        	@auth
			        <a class="nav-link text-light active" aria-current="page" href="#">Home</a>
			        <a class="nav-link text-light" href="#">Achievements</a>
			        <a class="nav-link text-light" href="{{route('lesson.list')}}">Lessons</a>
			        <a class="nav-link text-light" href="{{route('logout')}}">Logout</a>
			        <a class="nav-link text-light" href="#">{{auth()->user()->name}}</a>
			        @endauth
			        
			        @guest
			        <a class="nav-link text-light" href="{{route('register')}}">Register</a>
			        <a class="nav-link text-light" href="{{route('login')}}">Login</a>
			        @endguest
		        </div>
		    </div>
	    </div>
	</nav>

	<div class="container">
		@yield('content')
	</div>

	

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>
</html>