@extends('app')

@section('content')
	<div class="container">
		@include('errors.list')
	
		<div class="well">
			<h1 class="text-center">Edit {{ $planExercise->exercise->title}}</h1>
		</div>

		<div class="well">
			{!! Form::model($planExercise, ['method' => 'PATCH', 'action' => ['PlanExerciseController@update', $planExercise->id]]) !!}

				 <div class="form-group">
				    {!! Form::select('id[]', $exercises, $planExercise->exercise->title, ['class' => 'form-control', 'style' => 'width:100%']) !!}
				</div>

			    <div class="form-group">
				    {!! Form::number('weight_to_add_for_success', $planExercise->weight_to_add_for_success, ['class' => 'form-control','placeholder' => 'Weight to add after successful lift', 'style' => 'width:100%']) !!}
				</div>

				<div class="form-group">
				    {!! Form::number('weight_to_sub_for_fail', $planExercise->weight_to_sub_for_fail, ['class' => 'form-control', 'placeholder' => 'Weight to subtract after failed lift', 'style' => 'width:100%']) !!}
				</div>

				<div class="form-group">
					{!! Form::submit('Update Exercise', ['class' => 'btn btn-primary form-control']) !!}
				</div>

			{!! Form::close() !!}
		</div>

		<div class="well">
			{!! Form::open(array('url' => 'planExercises/' . $planExercise->id)) !!}
	            {!! Form::hidden('_method', 'DELETE') !!}
	            {!! Form::button('Delete', array('type' => 'submit', 'class' => 'btn btn-danger', 'style' => 'width:100%')) !!}
	        {!! Form::close() !!}
	    </div>

	</div>
@stop