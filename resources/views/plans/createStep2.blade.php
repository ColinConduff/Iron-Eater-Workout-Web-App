@extends('app')

@section('content')

	<div class="container">
		@include('errors.list')

		<div class="well text-center">
			<h4>Create a Plan</h4>
			<h3><small>Step 2: </small>Customize Workouts, Exercises, and Sets</h3>
		</div>

		@if($plan->planWorkouts->count())
			@foreach($plan->planWorkouts as $planWorkout)
				<div class="panel panel-default text-center">
					<div class="panel-heading">
						<h3 class="text-center">{{ $planWorkout->workout->title }} Workout</h3>
					</div>

					@if( $planWorkout->planExercises->count() )
						@foreach($planWorkout->planExercises as $planExercise)
							<div class="panel-body">
								<div class="row">
									<div class="col-sm-4">
										<h4>{{ $planExercise->exercise->title }}</h4>
									</div>

									<div class="col-sm-4">
										<h5>Add {{ $planExercise->weight_to_add_for_success }} lbs for successful lift</h5>
									</div>

									<div class="col-sm-4">
										<h5>Subtract {{ $planExercise->weight_to_add_for_success }} lbs for failed lift</h5>
									</div>
								</div>
							</div>

							@if($planExercise->planSets->count())
								<table class="table table-striped">
									<tr>
										<td>Set</td>
										<td>Reps</td>
										<td>Weight</td>
									</tr>
									@foreach($planExercise->planSets as $index => $planSet)
										<tr>
											<td>{{ $index+1 }}</td>
			    							<td>{{ $planSet->expected_reps }}</td>
			    							<td>{{ $planSet->expected_weight }}</td>
			    						</tr>
			        				@endforeach
			        			</table>
			        		@endif

			        		<div class="panel-body">
			        			<div class="row">
			        				{!! Form::open(['url' => 'planSets']) !!}
										<div hidden=true class="form-group">
											{!! Form::text('plan_id', $plan->id, ['class' => 'form-control']) !!}
										</div>

									    <div hidden=true class="form-group">
											{!! Form::text('plan_exercise_id', $planExercise->id, ['class' => 'form-control']) !!}
										</div>

										<div class="col-xs-6 col-sm-4 form-group">
										    {!! Form::number('expected_reps', '', ['class' => 'form-control', 'placeholder' => 'Reps']) !!}
										</div>

										<div class="col-xs-6 col-sm-4 form-group">
										    {!! Form::number('expected_weight', '', ['class' => 'form-control', 'placeholder' => 'Weight', 'style' => 'width:100%']) !!}
										</div>

										<div class="col-xs-12 col-sm-4 form-group">
											{!! Form::submit('Add Set', ['class' => 'btn btn-primary form-control']) !!}
										</div>
									{!! Form::close() !!}
								</div>
							</div>

						@endforeach
					@endif

					<div class="panel-footer">
						<div class="row">	
							{!! Form::open(['url' => 'planExercises']) !!}
								<div hidden=true class="form-group">
									{!! Form::text('plan_id', $plan->id, ['class' => 'form-control']) !!}
								</div>

							    <div hidden=true class="form-group">
									{!! Form::text('plan_workout_id', $planWorkout->id, ['class' => 'form-control']) !!}
								</div>

							    <div class="form-group col-md-4">
								    {!! Form::select('id[]', $exercises, null, ['class' => 'form-control', 'style' => 'width:100%']) !!}
								</div>

								<div class="form-group col-md-4">
								    {!! Form::number('weight_to_add_for_success', '', ['class' => 'form-control','placeholder' => 'Weight to add after successful lift', 'style' => 'width:100%']) !!}
								</div>

								<div class="form-group col-md-4">
								    {!! Form::number('weight_to_sub_for_fail', '', ['class' => 'form-control', 'placeholder' => 'Weight to subtract after failed lift', 'style' => 'width:100%']) !!}
								</div>

								<div class="form-group col-md-12">
									{!! Form::submit('Add Exercise', ['class' => 'btn btn-primary form-control']) !!}
								</div>

							{!! Form::close() !!}
						</div>
					</div>
				</div>
				<hr>
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

			<button class="btn btn-info btn-block" data-toggle="collapse" data-target="#createWk" style="margin-bottom:1em">
				Quickly Create a New Workout to Add Above
			</button>

			<div class="collapse" id="createWk">

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

		<div class="well">
			<a href="{{ url('plans/createStep3', [$plan->id]) }}" class="btn btn-success btn-block">
				Go to step 3
			</a>
		</div>
		
	</div>
@stop