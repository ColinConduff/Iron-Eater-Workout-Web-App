@extends('app')

@section('content')
	<div class="container-fluid">
		<h1 class="text-center">
			Workout: {{ $workout->title }} 
			<a href="{{ url('workouts', [$workout->id, 'edit']) }}" class="btn btn-default">
				Edit
			</a>
		</h1>

		<div class="well container">
		@if(count($currentSessions))
		<h3 class="text-center">Current Sessions</h3>
			@foreach ($currentSessions as $Session)
			<div class="row">
					<div class="col-sm-5 text-center">
						<h5>
							{{ $Session->exercise->title }} -
							<small>{{ date('F d g:i:s', strtotime($Session->session_date)) }}</small>
						</h5>
					@if( $Session->sessionSets->count() )
						@foreach ($Session->sessionSets as $index => $sessionSet)
								<div class="col-sm-12">{{ $index+1 }}:
								{{ $sessionSet->number_of_reps }} reps X
								{{ $sessionSet->weight_lifted }} lbs |
								1 rep max: {{ $sessionSet->one_rep_max }} |
								{{ date('g:i:s', strtotime($sessionSet->created_at)) }}</div>
						@endforeach
					@endif
					</div>

					<div class="col-sm-5">
						<div class="row">
						@include('errors.list')
						{!! Form::open(['action' => 'SessionSetController@store']) !!}

						<div hidden=true class="form-group">
							{!! Form::text('session_id', $Session->id, ['class' => 'form-control']) !!}
						</div>

						<div hidden=true class="form-group">
							{!! Form::text('workout_id', $workout->id, ['class' => 'form-control']) !!}
						</div>

						<div class="form-group col-sm-4 col-xs-6">
							{!! Form::text('number_of_reps', null, ['class' => 'form-control', 'placeholder' => "Reps"]) !!}
						</div>

						<div class="form-group col-sm-4 col-xs-6">
							{!! Form::text('weight_lifted', null, ['class' => 'form-control', 'placeholder' => "lbs"]) !!}
						</div>

						<div class="form-group col-sm-4 col-xs-12">
							{!! Form::submit('Add Set', ['class' => 'btn btn-primary form-control']) !!}
						</div>

						{!! Form::close() !!}
						</div>
					</div>

					<div class="col-sm-1 col-xs-6 text-center">
						<a href="{{ url('sessions', [$Session->id, 'edit']) }}" class="btn btn-info">
							<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
						</a>
					</div>

					<div class="col-sm-1 col-xs-6 text-center">
						{!! Form::open(array('url' => 'sessions/' . $Session->id)) !!}
		                    {!! Form::hidden('_method', 'DELETE') !!}
		                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>', array('type' => 'submit', 'class' => 'btn btn-danger')) !!}
		                {!! Form::close() !!}
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

		@endif
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
		</div>


		@if(count($pastSessions))
		<div class="well container text-center">
		<div class="row">
		<h3>Past Sessions</h3>
			@foreach ($pastSessions as $Session)
					<div class="col-sm-6">
						<h5>
							{{ $Session->exercise->title }} -
							<small>{{ date('F d g:i:s', strtotime($Session->session_date)) }}</small>
						</h5>
					@if( $Session->sessionSets->count() )
						@foreach ($Session->sessionSets as $index => $sessionSet)
								<div class="col-sm-12">{{ $index+1 }}:
								{{ $sessionSet->number_of_reps }} reps X
								{{ $sessionSet->weight_lifted }} lbs |
								1 rep max: {{ $sessionSet->one_rep_max }} |
								{{ date('g:i:s', strtotime($sessionSet->created_at)) }}</div>
						@endforeach
					@endif
					</div>
			@endforeach
		</div>
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