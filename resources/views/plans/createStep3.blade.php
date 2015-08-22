@extends('app')

@section('content')

	<div class="container">
		<div class="well">
			<h1>Step 3: Customize Exercises and Sets</h1>
		</div>

		@if($plan->planWorkouts->count())
			<div class="well">
				@foreach($plan->planWorkouts as $planWorkout)
					<h3>{{ $planWorkout->workout->title }}</h3>
					@foreach($planWorkout->planDates as $planDate)
						<h4>{{ $planDate->planned_date }}</h4>
					@endforeach
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
				@endforeach
			</div>
		@endif
	</div>
@stop