@extends('app')

@section('content')
	<div class="container">
		
		<div>@include('errors.list')</div>

		<a href="{{ url('workouts', [$workout->id]) }}">Back</a>
			
		<div class="well">
			<h1 class="text-center">
				Edit {{ $workout->title }} 
			</h1>
		</div>

		<div class="well">

			{!! Form::model($workout, ['method' => 'PATCH', 'action' => ['WorkoutController@update', $workout->id]]) !!}
			<div class="form-group">
				{!! Form::text('title', $workout->title, ['class' => 'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::textarea('note', $workout->note, ['class' => 'form-control', 'rows' => 4]) !!}
			</div>

			<div class="form-group">
				{!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
			</div>
			{!! Form::close() !!}

		</div>

		<div class="text-center well">
			{!! Form::open(array('url' => 'workouts/' . $workout->id)) !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                {!! Form::button('Delete Workout', array('type' => 'submit', 'class' => 'btn btn-block btn-danger')) !!}
            {!! Form::close() !!}
        </div>
	</div>
@stop