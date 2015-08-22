@extends('app')

@section('content')

	<div class="container">
		@include('errors.list')

		<div class="well">
			<h1>Step 2: Add Workouts to {{ $plan->title }}</h1>
		</div>

		@if($plan->planWorkouts->count())
			@foreach($plan->planWorkouts as $planWorkout)
					<div class="well">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="text-center">{{ $planWorkout->workout->title }} Workout</h3>
						</div>
					</div>

					@foreach($planWorkout->planExercises as $planExercise)
						<div class="row">
							<div class="col-sm-4">
								<h4 class="text-center">{{ $planExercise->exercise->title }}</h4>
							</div>

							<div class="col-sm-4 text-center">
								@if($planExercise->weight_to_add_for_success)
									<h5>Add {{ $planExercise->weight_to_add_for_success }} lbs for successful lift</h5>
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
							</div>

							<div class="col-sm-4 text-center">
								@if($planExercise->weight_to_sub_for_fail)
									<h5>Subtract {{ $planExercise->weight_to_sub_for_fail }} lbs for failed lift</h5>
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
							</div>
						</div>

						@if($planExercise->planSets->count())
							<div class="row text-center">
								<div class="col-sm-1">
									<h5>Set#</h5>
									<h5>Reps</h5>
									<h5>Weight</h5>
								</div>
								@foreach($planExercise->planSets as $index => $planSet)
									<div class="col-sm-1">
										<h5>{{ $index+1 }}</h5>
		    							<h5>{{ $planSet->expected_reps }}</h5>
		    							<h5>{{ $planSet->expected_weight }}</h5>
		    						</div>
		        				@endforeach
		        			</div>
		        		@endif

	        			<div class="row">
	        				{!! Form::open(['url' => 'planSets']) !!}
								<div hidden=true class="form-group">
									{!! Form::text('plan_id', $plan->id, ['class' => 'form-control']) !!}
								</div>

							    <div hidden=true class="form-group">
									{!! Form::text('plan_exercise_id', $planExercise->id, ['class' => 'form-control']) !!}
								</div>

								<div class="col-sm-4 form-group">
								    {!! Form::number('expected_reps', '', ['class' => 'form-control', 'placeholder' => 'Reps']) !!}
								</div>

								<div class="col-sm-4 form-group">
								    {!! Form::number('expected_weight', '', ['class' => 'form-control', 'placeholder' => 'Weight', 'style' => 'width:100%']) !!}
								</div>

								<div class="col-sm-4 form-group">
									{!! Form::submit('Add Set', ['class' => 'btn btn-primary form-control']) !!}
								</div>
							{!! Form::close() !!}
						</div>

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

				</div>
			@endforeach
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