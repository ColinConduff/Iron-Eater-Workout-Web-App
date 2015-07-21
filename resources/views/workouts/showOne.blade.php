@extends('app')

@section('content')
	<div class="container">
		<div class="well container">
			<h1 class="text-center">
				Workout: {{ $workout->title }} 
			</h1>
			<a href="{{ url('workouts', [$workout->id, 'edit']) }}" class="btn btn-default btn-danger pull-right">
				Edit
			</a>
		</div>

		<div class="well container">
		@if(count($currentSessions))
		<h3 class="text-center">Current Sessions</h3>
			@foreach ($currentSessions as $Session)
			<div class="row">
				<div class="col-sm-10 text-center">
					<h5>
						{{ $Session->exercise->title }} -
						<small>{{ date('F d g:i:s', strtotime($Session->session_date)) }}</small>
					</h5>
				@if( $Session->sessionSets->count() )
					<table class="table text-center">	
						<tr>
							<th>#</th>
							<th>Reps</th>
							<th>lbs</th>
							<th>One Rep Max</th>
							<th>Time</th>
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

				<div class="col-sm-2">
					<div class="row">
					@include('errors.list')
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
			@endforeach

			@include('errors.list')

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

			<script>
				$('#exercise_list').select2({
					placeholder: 'Choose exercises'
				});
			</script>

		@else
		<h3 class="text-center">Start a new workout session</h3>

			{{--
				If there are past sessions, get the exercises used
				in the past to create several new sessions at once 
			--}}

			@if(count($pastSessions))
				@include('errors.list')

				{!! Form::open(['action' => 'SessionController@startNewWorkout']) !!}

				<div hidden=true class="form-group">
					{!! Form::text('workout_id', $workout->id, ['class' => 'form-control']) !!}
				</div>

				<div class="form-group">
					{!! Form::submit('Start a new workout session', ['class' => 'btn btn-primary form-control']) !!}
				</div>

				{!! Form::close() !!}
			@else

			{{--
				If there are no past sessions to generate a list of 
				exercises from, then populate a multiple select input 
				field to generate new sessions.
			--}}
			
			@include('errors.list')

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

			<script>
				$('#exercise_list').select2({
					placeholder: 'Choose exercises'
				});
			</script>
			@endif
		@endif
		</div>


		@if(count($pastSessions))
		<div class="well container text-center">
		<h3>Past Sessions</h3>
			@foreach ($pastSessions as $Session)
					<h5>
						{{ $Session->exercise->title }} -
						<small>{{ date('F d g:i:s', strtotime($Session->session_date)) }}</small>
					</h5>
				@if( $Session->sessionSets->count() )
					<table class="table text-center">	
						<tr>
							<th>#</th>
							<th>Reps</th>
							<th>lbs</th>
							<th>One Rep Max</th>
							<th>Time</th>
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
			@endforeach
		</div>
		@endif

		<div class="well container">
			<h3 class="text-center">Note</h3>

			@include('errors.list')

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
	</div>
@stop