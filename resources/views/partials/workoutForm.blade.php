{!! Form::open(['url' => 'workouts']) !!}

<div class="form-group">
	{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
</div>

<div class="form-group">
	{!! Form::textarea('note', null, ['class' => 'form-control', 'placeholder' => 'Note', 'rows' => 4]) !!}
</div>

<div class="form-group">
	{!! Form::submit('Create Workout', ['class' => 'btn btn-primary form-control']) !!}
</div>

{!! Form::close() !!}