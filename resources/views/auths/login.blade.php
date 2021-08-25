@extends('layouts.base')
@section('content')
<div class="row mt-5">
	<div class="col-4 offset-4">
		<form action="" method="POST">
			@csrf
		    <div class="form-group">
			    <label for="email">Email:</label>
			    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
			    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
		    </div>
		    <div class="form-group">
			    <label for="pwd">Password:</label>
			    <input type="password" class="form-control @error('password') is-invalid @enderror" id="pwd" name="password">
			    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
		    </div>
		  	<div class="mt-2">
		  		<button type="submit" class="btn btn-danger">Submit</button>
		  	</div>
		    
		</form> 
	</div>
</div>
@endsection