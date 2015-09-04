@extends('app')

@section('content')
	<div class="container">

		<div>@include('errors.list')</div>

		<div class="well">
			<h1 class="text-center">{{ $workout->title }}</h1>
		</div>

		<div class="well">
			{!! Form::model($workout, ['method' => 'PATCH', 'action' => ['WorkoutController@update', $workout->id]]) !!}
			<div hidden=true class="form-group">
				{!! Form::text('title', $workout->title, ['class' => 'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::textarea('note', $workout->note, ['class' => 'form-control', 'rows' => 4]) !!}
			</div>

			<div class="form-group">
				{!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
			</div>
			{!! Form::close() !!}

		</div>

		<div class="well">
			<a href="{{ url('workouts', [$workout->id, 'edit']) }}" class="btn btn-block btn-danger">
				Edit Workout
			</a>
		</div>
	</div>
@stop