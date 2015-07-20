@extends('app')

@section('content')
	<div class="container text-center">
		<h1>Exercises</h1>

		<div class="panel panel-default">
			
			<div class="panel-heading">
				<h3 class="panel-title">
				<a href="{{ action('ExerciseController@sortTitleAsc') }}"class="btn btn-default">
					Title 
					<span class="glyphicon glyphicon-arrow-up"></span>
				</a>
				<a href="{{ action('ExerciseController@sortTitleDesc') }}" class="btn btn-default">
					Title 
					<span class="glyphicon glyphicon-arrow-down"></span>
				</a>
				<div class="btn-group" role="group">
				    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    	Type
				    	<span class="caret"></span>
				    </button>
				    <ul class="dropdown-menu">
				    	<li><a href="{{ url('exercises/type/Weighted') }}">Weighted</a></li>
				    	<li><a href="{{ url('exercises/type/Bodyweight') }}">Bodyweight</a></li>
				    	<li><a href="{{ url('exercises/type/Cardio') }}">Cardio</a></li>
				    	<li><a href="{{ url('exercises/type/Yoga') }}">Yoga</a></li>
				    </ul>
				</div>
				<div class="btn-group" role="group">
				    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    	Category
				    	<span class="caret"></span>
				    </button>
				    <ul class="dropdown-menu">
				    	<li><a href="{{ url('exercises/category/Chest') }}">Chest</a></li>
				    	<li><a href="{{ url('exercises/category/Back') }}">Back</a></li>
				    	<li><a href="{{ url('exercises/category/Triceps') }}">Triceps</a></li>
				    	<li><a href="{{ url('exercises/category/Biceps') }}">Biceps</a></li>
				    	<li><a href="{{ url('exercises/category/Legs') }}">Legs</a></li>
				    	<li><a href="{{ url('exercises/category/Shoulders') }}">Shoulders</a></li>
				    	<li><a href="{{ url('exercises/category/FullBody') }}">Full Body</a></li>
				    </ul>
				</div>
				<a href="{{ url('exercises') }}"class="btn btn-default">
					<span class="glyphicon glyphicon-remove"></span>
				</a>
				</h3>
			</div>

			<div class="panel-body">
				@if(count($exercises))
					@foreach($exercises as $exercise)
						<div style="padding-bottom:1%; padding-top:1%">
						<a href="{{ url('exercises', [$exercise->id]) }}">
							{{ $exercise->title }}
						</a>
						</div>
					@endforeach
				@else
					<h4>Nothing to see here...</h4>
				@endif
			</div>
		</div>

		<div class="well">

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
			    	 'FullBody' 	=> 'FullBody'], 
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