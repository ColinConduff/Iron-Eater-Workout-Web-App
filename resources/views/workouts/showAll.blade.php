@extends('app')

@section('content')
	<div class="container">	

		<div>@include('errors.list')</div>	

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

		<div class="well">
			<button class="btn btn-primary btn-block" data-toggle="collapse" data-target="#createWk">
				Create a New Workout
			</button>
		</div>

		<div class="well collapse" id="createWk">
			<h3 class="text-center">Create A New Workout</h3>

			{!! Form::open(['url' => 'workouts']) !!}

			<div class="form-group">
				{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
			</div>

			<div class="form-group">
				{!! Form::textarea('note', null, ['class' => 'form-control', 'placeholder' => 'Note', 'rows' => 4]) !!}
			</div>

			<div class="form-group">
				{!! Form::submit('Create Workout', ['class' => 'btn btn-primary form-control']) !!}
			</div>

			{!! Form::close() !!}
		</div>

	</div>
@stop