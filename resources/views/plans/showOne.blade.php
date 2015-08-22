@extends('app')

@section('content')

	<div class="container">
		@include('errors.list')

		<div class="well">
			<h1 class="text-center">{{ $plan->title }}</h1>
		</div>

		<div class="well">
			<h2>Calendar overview</h2>
		</div>

		@if($plan->planWorkouts->count())
			@foreach($plan->planWorkouts as $planWorkout)
					<div class="well">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="text-center">{{ $planWorkout->workout->title }} Workout</h3>
						</div>
					</div>

					@foreach($planWorkout->planExercises as $planExercise)
						<div class="row">
							<div class="col-sm-4">
								<h4 class="text-center">{{ $planExercise->exercise->title }}</h4>
							</div>

							<div class="col-sm-4 text-center">
								@if($planExercise->weight_to_add_for_success)
									<h5>Add {{ $planExercise->weight_to_add_for_success }} lbs for successful lift</h5>
								@endif
							</div>

							<div class="col-sm-4 text-center">
								@if($planExercise->weight_to_sub_for_fail)
									<h5>Subtract {{ $planExercise->weight_to_sub_for_fail }} lbs for failed lift</h5>
								@endif
							</div>
						</div>

						@if($planExercise->planSets->count())
							<div class="row text-center">
								<div class="col-sm-1">
									<h5>Set#</h5>
									<h5>Reps</h5>
									<h5>Weight</h5>
								</div>
								@foreach($planExercise->planSets as $index => $planSet)
									<div class="col-sm-1">
										<h5>{{ $index+1 }}</h5>
		    							<h5>{{ $planSet->expected_reps }}</h5>
		    							<h5>{{ $planSet->expected_weight }}</h5>
		    						</div>
		        				@endforeach
		        			</div>
		        		@endif

					@endforeach

				</div>
			@endforeach
		@endif
		
	</div>
@stop