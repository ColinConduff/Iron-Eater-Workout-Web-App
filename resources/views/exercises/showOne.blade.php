@extends('app')

@section('content')
	<div class="container text-center">
		<h1>{{ $exercise->title }}</h1> 
		<a href="{{ url('exercises') }}">View All Exercises</a>
		<a href="{{ url('exercises', [$exercise->id, 'edit']) }}" class="btn btn-default">
			Edit
		</a>

		<div class="well row">
			<div class="col-xs-4">
				<h3>Type: <small>{{ $exercise->type }}</small></h3>
			</div>
			<div class="col-xs-4">
				<h3>Category: <small>{{ $exercise->category }}</small></h3>
			</div>
			<div class="col-xs-4">
				<h3>Best One Rep Max: <small>{{ $exercise->best_one_rep_max }}</small></h3>
			</div>
		</div>

		<div class="well row">
		@if(count($exercise->sessions))	
			<h3>Exercise History</h3>		
			@foreach ($exercise->sessions as $session)
				<div class="text-center">
					<h5>{{ date('F d g:i:s', strtotime($session->session_date)) }}</h5>
					@if( $session->sessionSets->count() )
						<table class="table">
							<tr>
							<th>Index</th>
							<th>Reps</th>
							<th>lbs</th>
							<th>One Rep Max</th>
							<th>Time</th>
							</tr>
						@foreach ($session->sessionSets as $index => $sessionSet)
								<tr>
								<td>{{ $index+1 }}</td>
								<td>{{ $sessionSet->number_of_reps }}</td>
								<td>{{ $sessionSet->weight_lifted }}</td>
								<td>1 rep max: {{ $sessionSet->one_rep_max }}</td>
								<td>{{ date('g:i:s', strtotime($sessionSet->created_at)) }}</td>
								</tr>
						@endforeach
						</table>
					@else
					<p>Nothing to show</p>
					@endif
				</div>
			@endforeach
		@endif
		</div>
		
	</div>
@stop