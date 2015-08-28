@extends('app')

@section('content')

	<div class="container">
		@include('errors.list')

		<div class="well">
			<a href="{{ url('plans', [$plan->id, 'edit']) }}" class="btn">
				<span class="glyphicon glyphicon-pencil"></span> Edit Plan
			</a>
			<h1 class="text-center">{{ $plan->title }}</h1>
		</div>

		<div class="well">
			<h2>Calendar overview</h2>
			<a href="{{ url('plans', [$plan->id, 'editDates']) }}" class="btn">
				<span class="glyphicon glyphicon-pencil"></span> Edit Dates
			</a>
		</div>

		@if($plan->planWorkouts->count())
			@foreach($plan->planWorkouts as $planWorkout)
					<div class="well">
					<div class="row">
						<div class="col-sm-12">
							<a href="{{ url('planWorkouts', [$planWorkout->id, 'edit']) }}" class="btn pull-right">
								<span class="glyphicon glyphicon-pencil"></span> Edit Workout
							</a>
							<a href="" class="btn pull-right">
								<span class="glyphicon glyphicon-plus"></span> Add Exercise
							</a>
						</div>
						<div class="col-sm-12">
							<h3 class="text-center">{{ $planWorkout->workout->title }} Workout</h3>
						</div>
					</div>

					@foreach($planWorkout->planExercises as $planExercise)
						<div class="row">
							<div class="col-sm-6">
								<h4 class="text-center">{{ $planExercise->exercise->title }}</h4>
							</div>
							<div class="col-sm-6">
								<a href="{{ url('planExercises', [$planExercise->id, 'edit']) }}" class="btn pull-right">
									<span class="glyphicon glyphicon-pencil"></span> Edit Exercise
								</a>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 text-center">
								@if($planExercise->weight_to_add_for_success)
									<h5><span class="glyphicon glyphicon-plus"></span> {{ $planExercise->weight_to_add_for_success }} lbs for successful lift</h5>
								@endif
							</div>

							<div class="col-sm-6 text-center">
								@if($planExercise->weight_to_sub_for_fail)
									<h5><span class="glyphicon glyphicon-minus"></span> {{ $planExercise->weight_to_sub_for_fail }} lbs for failed lift</h5>
								@endif
							</div>
						</div>

						@if($planExercise->planSets->count())
							<div class="row text-center">
								<div class="col-sm-11">
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
		        				<div class="col-sm-1">
			        				<a href="{{ url('planSets', [$planExercise->planSets->first()->id, 'edit']) }}" class="btn pull-right">
										<span class="glyphicon glyphicon-pencil"></span> Edit Sets
									</a>
									<a href="{{ url('planSets', [$planExercise->planSets->first()->id]) }}" class="btn pull-right">
										<span class="glyphicon glyphicon-plus"></span> Add Sets
									</a>
								</div>
		        			</div>
		        		@endif

					@endforeach

				</div>
			@endforeach
		@endif

		<div class="well">
			<a href="" class="btn btn-primary btn-block">
				Add Workout
			</a>
		</div>
		
	</div>
@stop