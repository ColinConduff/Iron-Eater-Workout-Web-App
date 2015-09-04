@extends('app')

@section('content')
	
	<div class="container">
		@include('errors.list')

		<a href="{{ url('plans', [$plan->id]) }}">Back</a>

		<div class="well">
			<h1 class="text-center">Edit Dates for {{ $plan->title }}</h1>
		</div>

		<div class="well">
			{!! $calendar->calendar() !!}
    		{!! $calendar->script() !!}
    	</div>
				
		@foreach($plan->planWorkouts as $planWorkout)
			@if($planWorkout->planDates->count())
				<div class="well">
					<h3 class="text-center">{{ $planWorkout->workout->title }}</h3>
					
					<div class="row">
						@foreach($planWorkout->planDates as $planDate)
							<div class="col-xs-4">
								{!! Form::model($planDate, ['method' => 'PATCH', 'action' => ['PlanDateController@update', $planDate->id]]) !!}
									<div hidden=true class="form-group">
										{!! Form::text('plan_id', $plan->id, ['class' => 'form-control']) !!}
									</div>

								    <div hidden=true class="form-group">
										{!! Form::text('plan_workout_id', $planWorkout->id, ['class' => 'form-control']) !!}
									</div>

									<div class="form-group">
										{!! Form::input('date', 'planned_date', $planDate->planned_date, ['class' => 'form-control']) !!}
									</div>

									<div class="form-group">
										{!! Form::submit('Update Date', ['class' => 'btn btn-primary form-control']) !!}
									</div>
								{!! Form::close() !!}
								{!! Form::open(array('url' => 'planDates/' . $planDate->id)) !!}
						            {!! Form::hidden('_method', 'DELETE') !!}
						            {!! Form::button('Delete', array('type' => 'submit', 'class' => 'btn btn-danger', 'style' => 'width:100%')) !!}
						        {!! Form::close() !!}
							</div>
						@endforeach
					</div>
				</div>
			@endif
		@endforeach

	</div>

@stop