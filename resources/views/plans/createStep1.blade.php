@extends('app')

@section('content')

	<div class="container">
		@include('errors.list')

		<div class="well">
			<h1>Step 1: Create A New Plan</h1>
		</div>

		<div class="well">
			{!! Form::open(['url' => 'plans']) !!}

			<div class="form-group">
				{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
			</div>

			<div class="form-group">
				{!! Form::input('date', 'start_date', date('Y-m-d'), ['class' => 'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::input('date', 'end_date', date('Y-m-d'), ['class' => 'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::submit('Got to Step 2', ['class' => 'btn btn-primary form-control']) !!}
			</div>

			{!! Form::close() !!}
		</div>
	</div>
@stop