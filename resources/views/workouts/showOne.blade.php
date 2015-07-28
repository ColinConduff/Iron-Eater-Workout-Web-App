@extends('app')

@section('content')
	<div class="container">
		<div class="well">
			<h1 class="text-center">{{ $workout->title }}</h1>
		</div>

		<div>@include('errors.list')</div>
		
		@if(count($currentSessions))
			<div class="well">
			<div class="well" style="background-color:#E6E6E6"><h3 class="text-center">Current Sessions</h3></div>
			@foreach ($currentSessions as $Session)
			<div class="row">
				<div class="col-sm-9 text-center">
				<div class="panel panel-default text-center">
					<div class="panel-heading" style="background-color:#E6E6E6">
						<h5>
							{{ $Session->exercise->title }} -
							<small>{{ date('F d g:i:s', strtotime($Session->session_date)) }}</small>
						</h5>
					</div>
				@if( $Session->sessionSets->count() )
					<table class="table table-striped text-center">	
						<tr>
							<td>#</td>
							<td>Reps</td>
							<td>lbs</td>
							<td>One Rep Max</td>
							<td>Time</td>
						</tr>
						@foreach ($Session->sessionSets as $index => $sessionSet)
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
						{!! Form::text('session_id', $Session->id, ['class' => 'form-control']) !!}
					</div>

					<div hidden=true class="form-group">
						{!! Form::text('workout_id', $workout->id, ['class' => 'form-control']) !!}
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

			<div class="well" style="background-color:#E6E6E6">
				{!! Form::open(['url' => 'sessions']) !!}
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

			</div>

			<script>
				$('#exercise_list').select2({
					placeholder: 'Choose exercises'
				});
			</script>

		@else
			{{--
				If there are past sessions, get the exercises used
				in the past to create several new sessions at one time
			--}}

			@if(count($pastSessions))

				<div class="well">
				{!! Form::open(['action' => 'SessionController@startNewWorkout']) !!}

				<div hidden=true class="form-group">
					{!! Form::text('workout_id', $workout->id, ['class' => 'form-control']) !!}
				</div>

				<div class="form-group">
					{!! Form::submit('Start a new workout session', ['class' => 'btn btn-primary form-control']) !!}
				</div>

				{!! Form::close() !!}
				</div>

			@else

				{{--
					If there are no past sessions to generate a list of 
					exercises from, then populate a multiple select input 
					field to generate new sessions.
				--}}

				<div class="well">

				{!! Form::open(['url' => 'sessions']) !!}
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

				<script>
					$('#exercise_list').select2({
						placeholder: 'Choose exercises'
					});
				</script>
			@endif
		@endif


		{{-- Displays the workout sessions from the past week --}}

		@if(count($pastSessions))
			<div class="well text-center">
			<div class="well" style="background-color:#E6E6E6"><h3>Past Sessions</h3></div>
			
			@foreach ($pastSessions as $session)
				<div class="panel panel-default text-center">
					<div class="panel-heading" style="background-color:#E6E6E6">
					<div class="row">
						<div class="col-xs-12">
							<h5><a href="{{ url('sessions', [$session->id]) }}" class="btn btn-default btn-block">
								{{ $session->exercise->title }}
							</a></h5>
							<h6>{{ date('l, F d \a\t g:i:s a', strtotime($session->session_date)) }}</h6>
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
			@endforeach
			{!! $pastSessions->render() !!}
			</div>
		@endif

		<div class="well">
			{!! Form::model($workout, ['method' => 'PATCH', 'action' => ['WorkoutController@update', $workout->id]]) !!}
			<div hidden=true class="form-group">
				{!! Form::text('title', $workout->title, ['class' => 'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::textarea('note', $workout->note, ['class' => 'form-control', 'rows' => 4]) !!}
			</div>

			<div class="form-group">
				{!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
			</div>
			{!! Form::close() !!}

		</div>

		<div class="well">
			<a href="{{ url('workouts', [$workout->id, 'edit']) }}" class="btn btn-block btn-danger">
				Edit Workout
			</a>
		</div>
	</div>
@stop