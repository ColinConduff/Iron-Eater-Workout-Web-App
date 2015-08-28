@extends('app')

@section('content')
	
	<div class="container">
		@include('errors.list')

		@if (session('status'))
		    <div class="alert alert-success">
		        {{ session('status') }}
		    </div>
		@endif

		<a href="{{ url('plans', [$planExercise->planWorkout->plan_id]) }}">
			Back
		</a>

		<div class="well">
			<h1 class="text-center">Edit Planned Sets</h1>
		</div>

		<div class="well text-center">
			<div class="row">
				<div class="col-sm-1">
					<h5>Set</h5>
				</div>
				<div class="col-sm-4">
					<h5>Reps</h5>
				</div>
				<div class="col-sm-4">
					<h5>Weight</h5>
				</div>
				<div class="col-sm-3">
				</div>
			</div>
			@foreach($planExercise->planSets as $index => $planSet)
				<div class="row">
					<div class="col-sm-1">
						<h5>{{ $index+1 }}</h5>
					</div>
				{!! Form::model($planSet, ['method' => 'PATCH', 'action' => ['PlanSetController@update', $planSet->id]]) !!}
					<div hidden=true class="form-group">
						{!! Form::text('plan_id', $planExercise->planWorkout->plan_id, ['class' => 'form-control']) !!}
					</div>
				    <div hidden=true class="form-group">
						{!! Form::text('plan_exercise_id', $planExercise->id, ['class' => 'form-control']) !!}
					</div>

					<div class="col-sm-4 form-group">
					    {!! Form::number('expected_reps', $planSet->expected_reps, ['class' => 'form-control', 'placeholder' => 'Reps']) !!}
					</div>
				
					<div class="col-sm-4 form-group">
					    {!! Form::number('expected_weight', $planSet->expected_weight, ['class' => 'form-control', 'placeholder' => 'Weight', 'style' => 'width:100%']) !!}
					</div>

					<div class="col-sm-2 form-group">
						{!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
					</div>
				{!! Form::close() !!}

				{!! Form::open(array('url' => 'planSets/' . $planSet->id)) !!}
		            {!! Form::hidden('_method', 'DELETE') !!}
		            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>', array('type' => 'submit', 'class' => 'col-sm-1 btn btn-danger')) !!}
		        {!! Form::close() !!}
				</div>
			@endforeach
		</div>

	</div>

@stop