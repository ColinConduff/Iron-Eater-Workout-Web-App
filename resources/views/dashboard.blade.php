@extends('app')

@section('content')
	<div class="container">

		<div class="well">
			<div class="row">
				<div class="col-sm-4">
					<button class="btn btn-primary btn-block" data-toggle="modal" data-target="#createLogModal">
						Generate a Log
					</button>
				</div>
				<div class="col-sm-4">
					<button class="btn btn-primary btn-block" data-toggle="collapse" data-target="#createWk">
						Create a New Workout
					</button>
				</div>
				<div class="col-sm-4">
					<button class="btn btn-primary btn-block" data-toggle="collapse" data-target="#createEx">
						Create a New Exercise
					</button>
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

		<div class="well collapse" id="createWk">
			<h3 class="text-center">Create A New Workout</h3>

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

		<div class="well collapse" id="createEx">

			<h3 class="text-center">Create A New Exercise</h3>

			{!! Form::open(['action' => 'ExerciseController@store']) !!}

			<div class="form-group">
				{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
			</div>

			<div class="form-group">
			    {!! Form::select('type', 
			    	['Cardio' => 'Cardio','Weighted' =>'Weighted','Bodyweight' =>'Bodyweight','Yoga' =>'Yoga'], 
			    	null, 
			    	['class' => 'form-control', 'style' => 'width:100%']) 
			    !!}
			</div>

			<div class="form-group">
			    {!! Form::select('category', 
			    	['Chest' 		=> 'Chest',
			    	 'Back' 		=> 'Back',
			    	 'Triceps' 		=> 'Triceps',
			    	 'Biceps' 		=> 'Biceps',
			    	 'Legs' 		=> 'Legs',
			    	 'Shoulders' 	=> 'Shoulders',
			    	 'FullBody' 	=> 'FullBody'], 
			    	null, 
			    	['class' => 'form-control', 
			    	 'style' => 'width:100%']) 
			    !!}
			</div>

			<div class="form-group">
				{!! Form::submit('Add exercise', ['class' => 'btn btn-primary form-control']) !!}
			</div>

			{!! Form::close() !!}

		</div>

		@if(count($plans))
			<div class="well">
				{!! $calendar->calendar() !!}
	    		{!! $calendar->script() !!}
			</div>
		@else
			<div class="well text-center">
				<h4>You do not currently have any plans to show</h4>
				<a href="{{ url('plans', ['createStep1']) }}" class="btn btn-primary">
					Create a New Plan
				</a>
		@endif

	</div>
@stop