@extends('app')

@section('content')

	<div class="container">
		<div class="well text-center"><h1>Plans</h1></div>

		<div class="well text-center">
			@if(count($plans))
				@foreach($plans as $plan)
					<div class="row">
						<div class="col-sm-10">
							<a href="{{ url('plans', [$plan->id]) }}" class="btn btn-default btn-block">{{ $plan->title }}</a>
						</div>
						<div class="col-sm-2">
							{!! Form::open(array('url' => 'plans/' . $plan->id)) !!}
			                    {!! Form::hidden('_method', 'DELETE') !!}
			                    {!! Form::button('Delete', array('type' => 'submit', 'class' => 'btn btn-danger', 'style' => 'width:100%')) !!}
			                {!! Form::close() !!}
			            </div>
	                </div>
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