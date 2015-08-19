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