@extends('app')

@section('content')

	<div class="container text-center">
		<div class="panel panel-default text-center">
			<div class="panel-heading">
			<div class="row">
				<div class="col-xs-4">
					<h4>{{ $session->workout->title }}</h5>
				</div>
				<div class="col-xs-4">
					<h5>{{ $session->exercise->title }}</h5>
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

		<div class="well">
			<a href="{{ url('sessions', [$session->id, 'edit']) }}" class="btn btn-danger btn-block">Edit</a>
		</div>
	
	</div>

@stop