@extends('app')

@section('content')
	<div class="container">
		<div class="well text-center"><h1>{{ $exercise->title }}</h1></div>
		
		<div class="row text-center">
			<div class="col-xs-12 col-sm-4">
				<h5 class="well">Type: {{ $exercise->type }}</h5>
			</div>
			<div class="col-xs-12 col-sm-4">
				<h5 class="well">Category: {{ $exercise->category }}</h5>
			</div>
			<div class="col-xs-12 col-sm-4">
				<h5 class="well">Best One Rep Max: {{ $exercise->best_one_rep_max }}</h5>
			</div>
		</div>

		<div class="well">
			<a href="{{ url('exercises', [$exercise->id, 'edit']) }}" class="btn btn-danger btn-block">
				Edit
			</a>
		</div>

		@if(count($sessions))	
			<div class="well text-center">
				<h3>Exercise History</h3>		
			</div>

			@foreach ($sessions as $session)
				<div class="panel panel-default text-center">
					<div class="panel-heading">
						<h5>{{ date('l, F d g:i a', strtotime($session->session_date)) }}</h5>
					</div>
					@if( $session->sessionSets->count() )
						<table class="table table-striped">
							<tr>
								<td>Index</td>
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
								<td>1 rep max: {{ $sessionSet->one_rep_max }}</td>
								<td>{{ date('g:i:s a', strtotime($sessionSet->created_at)) }}</td>
								</tr>
						@endforeach
						</table>
					@else
					<p>Nothing to show</p>
					@endif
				</div>
			@endforeach
			</div>

			<div class="text-center">{!! $sessions->render() !!}</div>
		@endif
		
	</div>
@stop