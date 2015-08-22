@extends('app')

@section('content')

	<div class="container">
		@include('errors.list')

		<div class="well">
			<h1>Step 2: Add Workouts to {{ $plan->title }}</h1>
		</div>

		@if($plan->planWorkouts->count())
			<div class="well">
				@foreach($plan->planWorkouts as $planWorkout)
					<h3>{{ $planWorkout->workout->title }}</h3>

					@foreach($planWorkout->planExercises as $planExercise)
						<h4>{{ $planExercise->exercise->title }}</h4>
						
						@if($planExercise->weight_to_add_for_success)
							<h5>{{ $planExercise->weight_to_add_for_success }}</h5>
						@else
							{!! Form::model($planExercise, ['method' => 'PATCH', 'action' => ['PlanExerciseController@update', $planExercise->id]]) !!}

								<div hidden=true class="form-group">
									{!! Form::text('plan_id', $plan->id, ['class' => 'form-control']) !!}
								</div>

							    <div class="form-group">
								    {!! Form::number('weight_to_add_for_success', '', ['class' => 'form-control','placeholder' => 'Weight to add after successful lift', 'style' => 'width:100%']) !!}
								</div>

								<div class="form-group">
									{!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
								</div>

							{!! Form::close() !!}
						@endif

						@if($planExercise->weight_to_sub_for_fail)
							<h5>{{ $planExercise->weight_to_sub_for_fail }}</h5>
						@else
							{!! Form::model($planExercise, ['method' => 'PATCH', 'action' => ['PlanExerciseController@update', $planExercise->id]]) !!}

								<div hidden=true class="form-group">
									{!! Form::text('plan_id', $plan->id, ['class' => 'form-control']) !!}
								</div>
								
							    <div class="form-group">
								    {!! Form::number('weight_to_sub_for_fail', '', ['class' => 'form-control', 'placeholder' => 'Weight to subtract after failed lift', 'style' => 'width:100%']) !!}
								</div>

								<div class="form-group">
									{!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
								</div>

							{!! Form::close() !!}
						@endif

						@foreach($planExercise->planSets as $planSet)
        					<h5>{{ $planSet->expected_reps }}</h5>
        					<h5>{{ $planSet->expected_weight }}</h5>
        				@endforeach

					@endforeach

					{!! Form::open(['url' => 'planExercises']) !!}
						<div hidden=true class="form-group">
							{!! Form::text('plan_id', $plan->id, ['class' => 'form-control']) !!}
						</div>

					    <div hidden=true class="form-group">
							{!! Form::text('plan_workout_id', $planWorkout->id, ['class' => 'form-control']) !!}
						</div>

					    <div class="form-group">
						    {!! Form::select('id[]', $exercises, null, ['class' => 'form-control', 'multiple', 'style' => 'width:100%']) !!}
						</div>

						<div class="form-group">
							{!! Form::submit('Add Exercises', ['class' => 'btn btn-primary form-control']) !!}
						</div>
					{!! Form::close() !!}

				@endforeach
			</div>
		@endif

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