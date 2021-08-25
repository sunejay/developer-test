@extends('layouts.base')
@section('content')
<div class="row mt-5">
	<div class="col-4 offset-4">
		<form action="" method="POST">
			@csrf
		    <div class="form-group">
			    <label for="body">Comment:</label>
			    <textarea name="body" id="body" class="form-control @error('body') is-invalid @enderror">{{ old('body') }}</textarea>
			    @error('body')
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