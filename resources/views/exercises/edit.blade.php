@extends('app')

@section('content')
	<div class="container">
		<h1 class="text-center">Edit: {!! $exercise->title !!}</h1>

		<a href="{{ url('exercises') }}">View All Exercises</a>
		
		<hr/>

		@include('errors.list')

		{!! Form::model($exercise, ['method' => 'PATCH', 'action' => ['ExerciseController@update', $exercise->id]]) !!}
			<div class="form-group">
				{!! Form::label('title', 'Title:') !!}
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
			    	 'Full Body' 	=> 'Full Body'], 
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
@stop