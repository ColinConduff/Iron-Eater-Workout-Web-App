@extends('app')

@section('content')

	<div class="container text-center">
	<div class="well"><h1>Sessions</h1></div>

	<div class="well">

		<div class="row">@include('errors.list')</div>
		
		<div class="row">
		<div class="col-xs-6">
		{{-- Exercise filter form --}}
		
			{!! Form::open(['action' => 'SessionController@filterByExerciseTitle']) !!}

			<div class="form-group">
			    {!! Form::select('id[]', $exerciseList, null, ['class' => 'form-control', 'style' => 'width:100%']) !!}
			</div>

			<div class="form-group">
				{!! Form::submit('Filter by Exercise', ['class' => 'btn btn-primary form-control']) !!}
			</div>

			{!! Form::close() !!}
		</div>

		<div class="col-xs-6">
		{{-- Workout filter form --}}
			{!! Form::open(['action' => 'SessionController@filterByWorkoutTitle']) !!}

			<div class="form-group">
			    {!! Form::select('id[]', $workoutList, null, ['class' => 'form-control', 'style' => 'width:100%']) !!}
			</div>

			<div class="form-group">
				{!! Form::submit('Filter by Workout', ['class' => 'btn btn-primary form-control']) !!}
			</div>

			{!! Form::close() !!}
		</div>
		</div>

	</div>

	@if(count($sessions))
		@foreach ($sessions as $session)
			<div class="panel panel-default text-center">
				<div class="panel-heading">
				<div class="row">
					<div class="col-xs-4">
						<h4>{{ $session->workout->title }}</h5>
					</div>
					<div class="col-xs-4">
						<h5><a href="{{ url('sessions', [$session->id]) }}" class="btn btn-default">{{ $session->exercise->title }}</a></h5>
					</div>
					<div class="col-xs-4">
						<h5><small>{{ date('F d g:i:s a', strtotime($session->session_date)) }}</small></h5>
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
		{!! $sessions->render() !!}
	@endif
	</div>

@stop