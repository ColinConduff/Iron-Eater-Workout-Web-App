@extends('app')

@section('content')
	<div class="container-fluid">
		<a href="{{ url('workouts', [$workout->id]) }}">Back</a>
		<h1 class="text-center">
			Workout: {{ $workout->title }} 
		</h1>

		@if(count($currentSessions))
		<div class="well container">
		<h3 class="text-center">Current Sessions</h3>
			@foreach ($currentSessions as $Session)
					<hr style="border-color:black">
					<div class="text-center">
						<h4>{{ $Session->exercise->title }}</h4>
					</div>
					<div class="row">
						@include('errors.list')

						{!! Form::model($Session, ['method' => 'PATCH', 'action' => ['SessionController@update', $Session->id]]) !!}
						    <div hidden=true class="form-group">
								{!! Form::text('workout_id', $workout->id, ['class' => 'form-control']) !!}
							</div>

						    <div class="col-sm-4 col-xs-12 form-group">
							    {!! Form::select('id', $exerciseList, null, ['class' => 'form-control', 'style' => 'width:100%']) !!}
							</div>

							<div class="col-sm-4 col-xs-6 form-group">
								{!! Form::submit('Update Session', ['class' => 'btn btn-primary form-control']) !!}
							</div>
						{!! Form::close() !!}

						<div class="col-sm-4 col-xs-6 text-center">
							{!! Form::open(array('url' => 'sessions/' . $Session->id)) !!}
			                    {!! Form::hidden('_method', 'DELETE') !!}
			                    {!! Form::button('Delete Session', array('type' => 'submit', 'class' => 'btn btn-danger', 'style' => 'width:100%')) !!}
			                {!! Form::close() !!}
		                </div>
		            </div>
					@if( $Session->sessionSets->count() )
						@foreach ($Session->sessionSets as $index => $sessionSet)
							<div class="row">
								@include('errors.list')

								<div class="col-xs-2 col-sm-4 col-md-4 text-center">{{ $index+1 }}</div>

								{!! Form::model($sessionSet, ['method' => 'PATCH', 'action' => ['SessionSetController@update', $sessionSet->id]]) !!}
								<div class="col-xs-5 col-sm-4 col-md-4 form-group">
									{!! Form::text('number_of_reps', $sessionSet->number_of_reps, ['class' => 'form-control']) !!}
								</div>

								<div class="col-xs-5 col-sm-4 col-md-4 form-group">
									{!! Form::text('weight_lifted', $sessionSet->weight_lifted, ['class' => 'form-control']) !!}
								</div>

								<div class="col-xs-5 col-xs-offset-2 col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4 form-group">
									{!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
								</div>
								{!! Form::close() !!}

								<div class="col-xs-5 col-sm-4 col-md-4">
									{!! Form::open(array('url' => 'sessionSets/' . $sessionSet->id)) !!}
					                    {!! Form::hidden('_method', 'DELETE') !!}
					                    {!! Form::button('Delete Set', array('type' => 'submit', 'class' => 'btn btn-danger', 'style' => 'width:100%')) !!}
					                {!! Form::close() !!}
				                </div>
							</div>
						@endforeach
					@endif
			@endforeach
		</div>
		@endif

		<div class="well container">
			<h3 class="text-center">Edit Workout Title and Note</h3>

			@include('errors.list')

			{!! Form::model($workout, ['method' => 'PATCH', 'action' => ['WorkoutController@update', $workout->id]]) !!}
			<div class="form-group">
				{!! Form::text('title', $workout->title, ['class' => 'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::textarea('note', $workout->note, ['class' => 'form-control', 'rows' => 4]) !!}
			</div>

			<div class="form-group">
				{!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
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