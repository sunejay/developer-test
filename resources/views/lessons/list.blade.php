@extends('layouts.base')
@section('content')
<div class="row mt-5">
	<div class="col-6 offset-3">
		<div class="mb-5">
			@foreach ($lessons as $lesson)
			<h4>
				<a href="{{route('lesson.show', $lesson->id)}}" class="fw-bold">
			        {{ $lesson->title }}
				</a>
			</h4>
			@endforeach
		</div>

		{{ $lessons->links() }}
	</div>
</div>
@endsection