@extends('app')

@section('content')

	<div class="container">
		<div class="well">
			<h1>Step 2: Add Workouts to {{ $plan->title }}</h1>
		</div>

		@if($plan->planWorkouts->count())
			@foreach($plan->planWorkouts as $planWorkout)
				<h3>{{ $planWorkout->workout->title }}</h3>
			@endforeach
		@endif

		@include('errors.list')

		<div class="well">
			{!! Form::open(['url' => 'planWorkouts']) !!}
			    <div hidden=true class="form-group">
					{!! Form::text('plan_id', $plan->id, ['class' => 'form-control']) !!}
				</div>

			    <div class="form-group">
				    {!! Form::select('id[]', $workouts, null, ['id' => 'workout_list', 'class' => 'form-control', 'multiple', 'style' => 'width:100%']) !!}
				</div>

				<div class="form-group">
					{!! Form::submit('Add Workouts', ['class' => 'btn btn-primary form-control']) !!}
				</div>
			{!! Form::close() !!}
		</div>

		<script>
			$('#workout_list').select2({
				placeholder: 'Choose Workouts'
			});
		</script>

		<div class="well">
			<a href="{{ url('plans/createStep3', [$plan->id]) }}" class="btn btn-primary btn-block">
				Go to step 3
			</a>
		</div>
		
	</div>
@stop