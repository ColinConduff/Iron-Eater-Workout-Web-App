@extends('app')

@section('content')
	<div class="container">

		<div>@include('errors.list')</div>

		@if (session('status'))
		    <div class="alert alert-success text-center">
		        {{ session('status') }}
		    </div>
		@endif

		<div style="margin-bottom:1em; background-color:#337ab7; border-radius: 5px; padding:6px 12px;" class="text-center">
			<div class="row">	
				<div class="col-xs-3">
					<a class="btn btn-default btn-block" id="timeBtn" data-toggle="modal" data-target="#timerModal">
						<span class="glyphicon glyphicon-time"></span>
					</a>
				</div>
				<div class="col-xs-3">
					<a class="btn btn-default btn-block" data-toggle="modal" data-target="#noteModal">
						<span class="glyphicon glyphicon-book"></span>
					</a>
				</div>
				<div class="col-xs-3">
					<a href="{{ url('editLog') }}" class="btn btn-default btn-block">
						<span class="glyphicon glyphicon-pencil"></span>
					</a>
				</div>
				<div class="col-xs-3">
					<a class="btn btn-default btn-block" data-toggle="modal" data-target="#createLogModal">
						<span class="glyphicon glyphicon-plus"></span>
					</a>
				</div>
			</div>
		</div>

		<div class="modal fade" id="timerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<a class="btn btn-default btn-block thirtySec">30 Sec</a>
						<a class="btn btn-default btn-block oneMin">1 Min</a>
						<a class="btn btn-default btn-block twoMin">2 Min</a> 
						<a class="btn btn-default btn-block threeMin">3 Min</a> 
						<a class="btn btn-default btn-block fourMin">4 Min</a>
						<a class="btn btn-default btn-block fiveMin">5 Min</a>  
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					@if(count($planWorkout))	
						<div class="modal-header text-center">
							<h1>
								<a href="{{ url('workouts', [$planWorkout->workout_id]) }}">
									{{ $planWorkout->title }}
								</a>
							</h1>
						</div>
						
						<div class="modal-body">
							{!! Form::model($planWorkout, ['method' => 'PATCH', 'action' => ['WorkoutController@update', $planWorkout->workout_id]]) !!}
								<div hidden=true class="form-group">
									{!! Form::text('title', $planWorkout->title, ['class' => 'form-control']) !!}
								</div>

								<div class="form-group">
									{!! Form::textarea('note', $planWorkout->note, ['class' => 'form-control', 'rows' => 4]) !!}
								</div>

								<div class="form-group">
									{!! Form::submit('Save Note', ['class' => 'btn btn-primary form-control']) !!}
								</div>
							{!! Form::close() !!} 
						</div>
					@else
						<div class="modal-header text-center">
							<h1>No Workout to Display</h1>
						</div>

						<div class="modal-body text-center">
							<h3>
								Please schedule a workout for today within a plan
							    and then generate a log
							</h3>
						</div>
					@endif
					
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="createLogModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Generate a Log</h4>
					</div>
					<div class="modal-body">

						{!! Form::open(['url' => 'sessions']) !!}

						    <div class="form-group">
							    {!! Form::select('id[]', $exerciseList, null, ['id' => 'exercise_list', 'class' => 'form-control', 'multiple', 'style' => 'width:100%']) !!}
							</div>

							<div class="form-group">
								{!! Form::submit('Generate a Log from a List of Exercises', ['class' => 'btn btn-primary form-control']) !!}
							</div>

						{!! Form::close() !!}

						{!! Form::open(['url' => 'generateLogFromWK']) !!}

							<div class="form-group">
							    {!! Form::select('id[]', $todaysWorkoutList, null, ['placeholder' => 'Select a Workout', 'class' => 'form-control', 'style' => 'width:100%']) !!}
							</div>

							<div class="form-group">
								{!! Form::submit('Generate a Log from a Scheduled Workout', ['class' => 'btn btn-primary form-control']) !!}
							</div>

						{!! Form::close() !!}

						{!! Form::open(['url' => 'generateLogFromWK']) !!}

							<div class="form-group">
							    {!! Form::select('id[]', $planWorkoutList, null, ['placeholder' => 'Select a Workout', 'class' => 'form-control', 'style' => 'width:100%']) !!}
							</div>

							<div class="form-group">
								{!! Form::submit('Generate a Log from any Workout', ['class' => 'btn btn-primary form-control']) !!}
							</div>

						{!! Form::close() !!}

					</div>
				</div>
			</div>
		</div>
		
		@if(count($currentSessions))

			<div class="well">

			@foreach ($currentSessions as $session)
			<div class="row">
				<div class="col-sm-9 text-center">
				<div class="panel panel-default text-center">
					<div class="panel-heading" style="background-color:#E6E6E6">
						<div class="row">
							<div class="col-xs-3">
								@if(count($planWorkout))
									{!! Form::open(['url' => 'successfulLift']) !!}

										<div hidden=true class="form-group">
											{!! Form::text('plan_workout_id', $planWorkout->id, ['class' => 'form-control']) !!}
										</div>

										<div hidden=true class="form-group">
											{!! Form::text('exercise_title', $session->exercise->title, ['class' => 'form-control']) !!}
										</div>

										<div class="form-group">
											{!! Form::button('<span class="glyphicon glyphicon-ok"></span>', ['type' => 'submit', 'class' => 'btn btn-success btn-block form-control']) !!}
										</div>

									{!! Form::close() !!}
								@endif
							</div>

							<div class="col-xs-6">
								<a href="{{ url('exercises', [$session->exercise->id]) }}" class="btn btn-block">
									{{ $session->exercise->title }}
								</a>
							</div>

							<div class="col-xs-3">
								@if(count($planWorkout))
									{!! Form::open(['url' => 'failedLift']) !!}

										<div hidden=true class="form-group">
											{!! Form::text('plan_workout_id', $planWorkout->id, ['class' => 'form-control']) !!}
										</div>

										<div hidden=true class="form-group">
											{!! Form::text('exercise_title', $session->exercise->title, ['class' => 'form-control']) !!}
										</div>

										<div class="form-group">
											{!! Form::button('<span class="glyphicon glyphicon-remove"></span>', ['type' => 'submit', 'class' => 'btn btn-danger btn-block form-control']) !!}
										</div>

									{!! Form::close() !!}
								@endif
							</div>
						</div>
					</div>
				@if( $session->sessionSets->count() )
					<table class="table table-striped text-center">	
						<tr>
							<td>#</td>
							<td>Reps</td>
							<td>lbs</td>
							<td>One Rep Max</td>
							<td>Time</td>
						</tr>
						@foreach ($session->sessionSets as $index => $sessionSet)
							<tr>
							<td>{{ $index+1 }}</td>
							<td>{{ $sessionSet->number_of_reps }}</td>
							<td>{{ $sessionSet->weight_lifted }}</td>
							<td>{{ $sessionSet->one_rep_max }}</td>
							<td>{{ date('g:i:s a', strtotime($sessionSet->created_at)) }}</td>
							</tr>
						@endforeach
					</table>
				@endif
				</div>
				</div>

				<div class="col-sm-3">
					<div class="well" style="background-color:#E6E6E6">
					<div class="row">
					{!! Form::open(['action' => 'SessionSetController@store']) !!}

					<div hidden=true class="form-group">
						{!! Form::text('session_id', $session->id, ['class' => 'form-control']) !!}
					</div>

					<div class="form-group col-sm-12 col-xs-4">
						{!! Form::text('number_of_reps', null, ['class' => 'form-control', 'placeholder' => "Reps"]) !!}
					</div>

					<div class="form-group col-sm-12 col-xs-4">
						{!! Form::text('weight_lifted', null, ['class' => 'form-control', 'placeholder' => "lbs"]) !!}
					</div>

					<div class="form-group col-sm-12 col-xs-4">
						{!! Form::submit('Add Set', ['class' => 'btn btn-primary form-control']) !!}
					</div>

					{!! Form::close() !!}
					</div>
					</div>
				</div>
	        </div>
			@endforeach
		@else
			<div class="well">
				<h2 class="text-center">
					Select the 
					<small style="color:black"><span class="glyphicon glyphicon-plus"></span></small>
				 	button to generate a new log from: 
				</h2>
				<ul>
					<li>A List of exercises</li>
					<li>A List of workouts you scheduled for today</li>
					<li>A List of all of your workouts</li>
				</ul>
			</div>
		@endif
	</div>
@stop