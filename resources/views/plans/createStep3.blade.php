@extends('app')

@section('content')

	<div class="container">
		@include('errors.list')

		<div class="well">
			<h1>Step 3: Add Dates</h1>
		</div>

		<div class="well">
			{!! $calendar->calendar() !!}
    		{!! $calendar->script() !!}
    	</div>

		@if($plan->planWorkouts->count())
			<div class="well">
				<div class="row">
					@foreach($plan->planWorkouts as $planWorkout)
						<div class="col-xs-4">
							<h3 class="text-center">{{ $planWorkout->workout->title }}</h3>
							
							{!! Form::open(['url' => 'planDates']) !!}
								<div hidden=true class="form-group">
									{!! Form::text('plan_id', $plan->id, ['class' => 'form-control']) !!}
								</div>

							    <div hidden=true class="form-group">
									{!! Form::text('plan_workout_id', $planWorkout->id, ['class' => 'form-control']) !!}
								</div>

								<div class="form-group">
									{!! Form::input('date', 'planned_date', date('Y-m-d'), ['class' => 'form-control']) !!}
								</div>

								<div class="form-group">
									{!! Form::submit('Add Date', ['class' => 'btn btn-primary form-control']) !!}
								</div>
							{!! Form::close() !!}
						</div>
					@endforeach
				</div>
			</div>
		@else
			<div class="well">
				<h2>You may have forgotten to add workouts to your plan...</h2>
			</div>
		@endif

		<div class="well">
			<a href="{{ url('plans', [$plan->id]) }}" class="btn btn-block btn-primary">
				Finish Creating Plan
			</a>
		</div>
	</div>
@stop