@extends('app')

@section('content')

	<div class="container">
		<div class="well text-center"><h1>Plans</h1></div>

		
		@if(count($plans))
			<div class="well text-center">
				@foreach($plans as $plan)
					<a href="{{ url('plans', [$plan->id]) }}" class="btn btn-default btn-block">{{ $plan->title }}</a>
				@endforeach
			</div>
		@endif
		

		<div class="well">
			<a href="{{ url('plans/createStep1') }}" class="btn btn-primary btn-block">Create A New Plan</a>
		</div>

		<div class="well">
			{!! $calendar->calendar() !!}
    		{!! $calendar->script() !!}
		</div>
	</div>
@stop