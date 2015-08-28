@extends('app')

@section('content')
	
	<div class="container">
		@include('errors.list')
		
		<div class="well">
			@foreach($plan->planWorkouts as $planWorkout)
				<h3 class="text-center">{{ $planWorkout->workout->title }}</h3>
				
				@foreach($planWorkout->planDates as $planDate)
					<h4>{{ $planDate->planned_date }}</h4>
				@endforeach
				
				{!! Form::model($planDate, ['method' => 'PATCH', 'action' => ['PlanDateController@update', $planDate->id]]) !!}
					<div hidden=true class="form-group">
						{!! Form::text('plan_id', $plan->id, ['class' => 'form-control']) !!}
					</div>

				    <div hidden=true class="form-group">
						{!! Form::text('plan_workout_id', $planWorkout->id, ['class' => 'form-control']) !!}
					</div>

					<div class="form-group">
						{!! Form::input('date', 'planned_date', date('Y-m-d'), ['class' => 'form-control']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Update Date', ['class' => 'btn btn-danger form-control']) !!}
					</div>
				{!! Form::close() !!}
			@endforeach
		</div>

		<div class="well">
			{!! Form::open(array('url' => 'planDates/' . $planDate->id)) !!}
	            {!! Form::hidden('_method', 'DELETE') !!}
	            {!! Form::button('Delete', array('type' => 'submit', 'class' => 'btn btn-danger', 'style' => 'width:100%')) !!}
	        {!! Form::close() !!}
	    </div>
	</div>

@stop