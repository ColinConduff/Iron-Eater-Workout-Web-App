@extends('app')

@section('content')
	<div class="container">
			@include('errors.list')

			<div class="well">
				<h1 class="text-center">Edit {{ $plan->title }} Plan</h1>
			</div>

			<div class="well">
			{!! Form::model($plan, ['method' => 'PATCH', 'action' => ['PlanController@update', $plan->id]]) !!}

				<div class="form-group">
					{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
				</div>

				<div class="form-group">
					{!! Form::input('date', 'start_date', $plan->start_date, ['class' => 'form-control']) !!}
				</div>

				<div class="form-group">
					{!! Form::input('date', 'end_date', $plan->end_date, ['class' => 'form-control']) !!}
				</div>

				<div class="form-group">
					{!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
				</div>

			{!! Form::close() !!}
			</div>

			<div class="well">
				{!! Form::open(array('url' => 'plans/' . $plan->id)) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::button('Delete', array('type' => 'submit', 'class' => 'btn btn-danger', 'style' => 'width:100%')) !!}
                {!! Form::close() !!}
            </div>

	</div>
@stop