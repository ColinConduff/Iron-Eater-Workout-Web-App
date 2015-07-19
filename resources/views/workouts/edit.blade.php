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

					<div class="col-sm-1 col-xs-6 text-center">
						<a href="{{ url('sessions', [$Session->id, 'edit']) }}" class="btn btn-info">
							Save
						</a>
					</div>

					<div class="col-sm-1 col-xs-6 text-center">
						{!! Form::open(array('url' => 'sessions/' . $Session->id)) !!}
		                    {!! Form::hidden('_method', 'DELETE') !!}
		                    {!! Form::button('Delete Session', array('type' => 'submit', 'class' => 'btn btn-danger')) !!}
		                {!! Form::close() !!}
	                </div>
	        </div>
			@endforeach
		@endif
		</div>

		<div class="well container">
			<h3 class="text-center">Edit</h3>

			@include('errors.list')

			{!! Form::model($workout, ['method' => 'PATCH', 'action' => ['WorkoutController@update', $workout->id]]) !!}
			<div class="form-group">
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

		<div class="text-center well container">
			{!! Form::open(array('url' => 'workouts/' . $workout->id)) !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                {!! Form::button('Delete Workout', array('type' => 'submit', 'class' => 'btn btn-block btn-danger')) !!}
            {!! Form::close() !!}
        </div>
	</div>
@stop