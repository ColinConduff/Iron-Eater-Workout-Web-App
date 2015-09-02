@extends('app')

@section('content')

	<div class="container">
		<div class="well text-center"><h1>Plans</h1></div>

		<div class="well text-center">
			@if(count($plans))
				@foreach($plans as $plan)
					<a href="{{ url('plans', [$plan->id]) }}" class="btn btn-default btn-block">{{ $plan->title }}</a>
				@endforeach
			@endif
		</div>

		<div class="well">
			<a href="{{ url('plans/createStep1') }}" class="btn btn-primary btn-block">Create A New Plan</a>
		</div>

		<div class="well">
			{!! $calendar->calendar() !!}
    		{!! $calendar->script() !!}
		</div>
	</div>
@stop