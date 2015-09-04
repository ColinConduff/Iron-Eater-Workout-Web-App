@extends('app')

@section('content')
	<div class="container">
		<div>@include('errors.list')</div>
		
		<a href="{{ url('exercises', [$exercise->id]) }}">Back</a>

		<div class="well">
			<h1 class="text-center">Edit: {!! $exercise->title !!}</h1>
		</div>

		<div class="well">

			{!! Form::model($exercise, ['method' => 'PATCH', 'action' => ['ExerciseController@update', $exercise->id]]) !!}
				<div class="form-group">
					{!! Form::text('title', null, ['class' => 'form-control']) !!}
				</div>

				<div class="form-group">
				    {!! Form::select('type', 
				    	['Cardio' => 'Cardio','Weighted' =>'Weighted','Bodyweight' =>'Bodyweight','Yoga' =>'Yoga'], 
				    	null, 
				    	['class' => 'form-control', 'style' => 'width:100%']) 
				    !!}
				</div>

				<div class="form-group">
				    {!! Form::select('category', 
				    	['Chest' 		=> 'Chest',
				    	 'Back' 		=> 'Back',
				    	 'Triceps' 		=> 'Triceps',
				    	 'Biceps' 		=> 'Biceps',
				    	 'Legs' 		=> 'Legs',
				    	 'Shoulders' 	=> 'Shoulders',
				    	 'FullBody' 	=> 'FullBody'], 
				    	null, 
				    	['class' => 'form-control', 
				    	 'style' => 'width:100%']) 
				    !!}
				</div>

				<div class="form-group">
					{!! Form::submit('Edit Exercise', ['class' => 'btn btn-primary form-control']) !!}
				</div>
			{!! Form::close() !!}
		</div>


		<div class="text-center well">
			{!! Form::open(array('url' => 'exercises/' . $exercise->id)) !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                {!! Form::button('Delete Workout', array('type' => 'submit', 'class' => 'btn btn-block btn-danger')) !!}
            {!! Form::close() !!}
        </div>
	</div>
@stop