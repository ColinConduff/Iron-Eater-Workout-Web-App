@extends('app')

@section('content')

	<div class="container">
		<div class="well">
			<h1>Step 2: Add Workouts to {{ $plan->title }}</h1>
		</div>

		@if($plan->planWorkouts->count())
			@foreach($plan->planWorkouts as $planWorkout)
				<h3>{{ $planWorkout->workout_id->title }}</h3>
				<h4>Form for selecting planDates</h4>
			@endforeach
		@endif

		{{--
		<div class="well">
			{!! Form::open(['url' => 'planWorkouts']) !!}
			    <div hidden=true class="form-group">
					{!! Form::text('workout_id', $workout->id, ['class' => 'form-control']) !!}
				</div>

			    <div class="form-group">
				    {!! Form::select('id[]', $exercises, null, ['id' => 'exercise_list', 'class' => 'form-control', 'multiple', 'style' => 'width:100%']) !!}
				</div>

				<div class="form-group">
					{!! Form::submit('Add Session', ['class' => 'btn btn-primary form-control']) !!}
				</div>
			{!! Form::close() !!}
		</div>
		--}}

		<div class="well">
			<a href="{{ url('plans/createStep3', [$plan->id]) }}" class="btn btn-primary btn-block">
				Go to step 3
			</a>
		</div>
		
	</div>
@stop