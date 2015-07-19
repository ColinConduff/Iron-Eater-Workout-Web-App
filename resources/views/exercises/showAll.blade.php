@extends('app')

@section('content')
	<div class="container">
		<h1>Exercises</h1>

		@if(count($exercises))
			@foreach($exercises as $exercise)
				<div class="well row">
				<a href="{{ url('exercises', [$exercise->id]) }}">
					<div class="col-sm-4 col-xs-4">{{ $exercise->title }}</div>
					<div class="col-sm-4 col-xs-4 text-center">
						<a href="{{ url('exercises', [$exercise->id, 'edit']) }}" class="btn btn-info">
							<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
						</a>
					</div>

					<div class="col-sm-4 col-xs-4 text-center">
						{!! Form::open(array('url' => 'exercises/' . $exercise->id)) !!}
			                {!! Form::hidden('_method', 'DELETE') !!}
			                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>', array('type' => 'submit', 'class' => 'btn btn-danger')) !!}
			            {!! Form::close() !!}
			        </div> 
				</a>
				</div>
			@endforeach
		@endif

		<div class="well row">

		<h2 class="text-center">Create A New Exercise</h2>

		@include('errors.list')
		{!! Form::open(['action' => 'ExerciseController@store']) !!}

		<div class="form-group">
			{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
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
			{!! Form::submit('Add exercise', ['class' => 'btn btn-primary form-control']) !!}
		</div>

		{!! Form::close() !!}

		</div>

	</div>
@stop