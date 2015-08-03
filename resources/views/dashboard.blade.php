@extends('app')

@section('content')
	<div class="container">
		@if(count($workouts))
			<div class="well">
			<h3 class="text-center">Select A Workout</h3>
			@foreach ($workouts as $workout)
				<div class="text-center">
				<a class="btn btn-default btn-lg" style="width:100%" href="{{ url('workouts', [$workout->id]) }}">{{ $workout->title }}</a>
				</div>
			@endforeach
			</div>
		@endif

		<script>
			$('document').ready(function() {
  				$('.createWkForm').on('click', function () {
  					$('.WkForm').removeClass('hidden');
  					$('.hideWell').addClass('hidden');
  				});
  			});
		</script>

		<div class="well hideWell">
			<button class="btn btn-default btn-primary btn-block createWkForm">Create a New Workout</button>
		</div>

		<div class="well hidden WkForm">
			<h3 class="text-center">Create A New Workout</h3>
			@include('errors.list')

			{!! Form::open(['url' => 'workouts']) !!}

			<div class="form-group">
				{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
			</div>

			<div class="form-group">
				{!! Form::textarea('note', null, ['class' => 'form-control', 'placeholder' => 'Note', 'rows' => 4]) !!}
			</div>

			<div class="form-group">
				{!! Form::submit('Create A New Workout', ['class' => 'btn btn-primary form-control']) !!}
			</div>

			{!! Form::close() !!}
		</div>

	</div>
@stop