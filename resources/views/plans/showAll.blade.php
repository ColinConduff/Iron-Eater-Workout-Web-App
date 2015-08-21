@extends('app')

@section('content')

	<div class="container">
		<div class="well text-center"><h1>Plans</h1></div>

		<div class="well text-center">
			@if(count($plans))
				@foreach($plans as $plan)
					<a href="" class="btn btn-default btn-block">{{ $plan->title }}</a>
					{!! Form::open(array('url' => 'plans/' . $plan->id)) !!}
	                    {!! Form::hidden('_method', 'DELETE') !!}
	                    {!! Form::button('Delete Plan', array('type' => 'submit', 'class' => 'btn btn-danger', 'style' => 'width:100%')) !!}
	                {!! Form::close() !!}
				@endforeach
			@endif
		</div>

		<div class="well">
			<a href="{{ url('plans/createStep1') }}" class="btn btn-primary btn-block">Create A New Plan</a>
		</div>

		<div class="well">
			<h3>Calendar</h3>
		</div>
	</div>
@stop