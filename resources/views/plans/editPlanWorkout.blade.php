@extends('app')

@section('content')
	
	<div class="container">
		@include('errors.list')

		<div class="well">
			<h1 class="text-center">Edit {{ $planWorkout->workout->title }} Workout</h1>
		</div>

		<div class="well">
			{!! Form::model($planWorkout, ['method' => 'PATCH', 'action' => ['PlanWorkoutController@update', $planWorkout->id]]) !!}
			    <div hidden=true class="form-group">
					{!! Form::text('plan_id', $planWorkout->plan_id, ['class' => 'form-control']) !!}
				</div>

			    <div class="form-group">
				    {!! Form::select('id[]', $workouts, null, ['class' => 'form-control', 'style' => 'width:100%']) !!}
				</div>

				<div class="form-group">
					{!! Form::submit('Update Workout', ['class' => 'btn btn-primary form-control']) !!}
				</div>
			{!! Form::close() !!}
		</div>

		<div class="well">
			{!! Form::open(array('url' => 'planWorkouts/' . $planWorkout->id)) !!}
	            {!! Form::hidden('_method', 'DELETE') !!}
	            {!! Form::button('Delete', array('type' => 'submit', 'class' => 'btn btn-danger', 'style' => 'width:100%')) !!}
	        {!! Form::close() !!}
	    </div>

	</div>

@stop