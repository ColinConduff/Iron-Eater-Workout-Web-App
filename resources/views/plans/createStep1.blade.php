@extends('app')

@section('content')

	<div class="container">
		@include('errors.list')

		<div class="well text-center">
			<h4>Create a Plan</h4>
			<h1><small>Step 1: </small>Choose a Title</h1>
		</div>

		<div class="well">
			{!! Form::open(['url' => 'plans']) !!}

			<div class="form-group">
				{!! Form::label('title', 'Title') !!}

				{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('title', 'Start Date') !!}

				{!! Form::input('date', 'start_date', date('Y-m-d'), ['class' => 'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('title', 'End Date') !!}

				{!! Form::input('date', 'end_date', date('Y-m-d'), ['class' => 'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::submit('Got to Step 2', ['class' => 'btn btn-success form-control']) !!}
			</div>

			{!! Form::close() !!}
		</div>
	</div>
@stop