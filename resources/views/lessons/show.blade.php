@extends('layouts.base')
@section('content')
<div class="row mt-5">
	<div class="col-6 offset-3">
		<h4 class="fw-bold">
			<a href="">
	        {{ $lesson->title }}
		</h4>
		<form action="{{route('watch', $lesson->id)}}" method="POST">
			@csrf
			<input type="hidden" name="id" value="{{$lesson->id}}">
			<button type="submit" class="btn btn-danger my-5">Watch</button>
		</form>
		<a href="{{route('comment.write')}}">Write Comment</a>
	</div>
</div>
@endsection