@extends('app')

@section('content')
	<div class="container">
		<div>@include('errors.list')</div>

		@if (session('status'))
		    <div class="alert alert-success text-center">
		        {{ session('status') }}
		    </div>
		@endif

		<div class="well text-center">
			<h1>Body Weight Tracker</h1>
		</div>

		@if($user->height_inches)
			<div class="well text-center">
				<div class="row">	
					<div class="col-xs-8">
					<h3>User: {{ $user->name }}</h3>
					</div>
					<div class="col-xs-4">
					<h5>Height: {{ floor($user->height_inches / 12) }} feet, {{ $user->height_inches % 12 }} inches</h5>
					</div>
				</div>
				@if(count($bodyweights))
					<div class="row">	
						<div class="col-xs-3">
							<h4>Body Weight</h4>
						</div>
						<div class="col-xs-3">
							<h4>BMI</h4>
						</div>
						<div class="col-xs-3">
							<h4>Recorded at</h4>
						</div>
						<div class="col-xs-3">
							<h4>Edit</h4>
						</div>
					</div>

					@foreach($bodyweights as $index => $bodyweight)
						<div class="row">	
							<div class="col-xs-3">
								<h5>{{ $bodyweight->bodyweight }}</h5>
							</div>
							<div class="col-xs-3">
								<h5>{{ $bodyweight->bmi }}</h5>
							</div>
							<div class="col-xs-3">
								<h5>{{ $bodyweight->updated_at }}</h5>
							</div>
							<div class="col-xs-3">
								<button class="btn btn-info" data-toggle="collapse" data-target="#update{{ $index }}">
									<span class="glyphicon glyphicon-pencil"></span>
								</button>
							</div>
						</div>

						<div class="row collapse" id="update{{ $index }}" style="margin-top:1em">
							{!! Form::model($bodyweight, ['method' => 'PATCH', 'action' => ['BodyweightController@update', $bodyweight->id]]) !!}

							<div class="col-xs-3 form-group">
							    {!! Form::text('bodyweight', null, ['class' => 'form-control','placeholder' => 'Body Weight in Pounds', 'style' => 'width:100%']) !!}
							</div>

							<div class="col-xs-6 form-group">
								{!! Form::submit('Update Body Weight', ['class' => 'btn btn-primary form-control']) !!}
							</div>

							{!! Form::close() !!}

							<div class="col-xs-3">
								{!! Form::open(array('url' => 'bodyweights/' . $bodyweight->id)) !!}
					                {!! Form::hidden('_method', 'DELETE') !!}
					                {!! Form::button('<span class="glyphicon glyphicon-trash"></span>', array('type' => 'submit', 'class' => 'btn btn-danger')) !!}
					            {!! Form::close() !!}
					        </div>
					    </div>
					@endforeach
				@endif
			</div>

			<div class="well">
				<div class="row">
					<div class="col-xs-6">
						<button class="btn btn-primary btn-block" data-toggle="collapse" data-target="#heightForm">Update Height</button>
					</div>
					<div class="col-xs-6">
						<button class="btn btn-primary btn-block" data-toggle="collapse" data-target="#weightForm">New Body Weight</button>
					</div>
				</div>
			</div>

			<div class="well collapse" id="heightForm">
				{!! Form::model($user, ['method' => 'PATCH', 'action' => ['UserController@update', $user->id]]) !!}

				<div class="form-group">
				    {!! Form::number('height_inches', $user->height_inches, ['class' => 'form-control','placeholder' => 'Height in Inches', 'style' => 'width:100%']) !!}
				</div>

				<div class="form-group">
					{!! Form::submit('Update Height', ['class' => 'btn btn-primary form-control']) !!}
				</div>

				{!! Form::close() !!}
			</div>


			<div class="well collapse" id="weightForm">
				{!! Form::open(['url' => 'bodyweights']) !!}

				<div class="form-group">
				    {!! Form::number('bodyweight', null, ['class' => 'form-control','placeholder' => 'Body Weight in Pounds', 'style' => 'width:100%']) !!}
				</div>

				<div class="form-group">
					{!! Form::submit('Record Body Weight', ['class' => 'btn btn-primary form-control']) !!}
				</div>

				{!! Form::close() !!}
			</div>
		@else 
			<div class="well text-center">
				<h2>To get started, record your height in inches</h2>
			</div>
			<div class="well">
				{!! Form::model($user, ['method' => 'PATCH', 'action' => ['UserController@update', $user->id]]) !!}

					<div class="form-group">
					    {!! Form::number('height_inches', '', ['class' => 'form-control','placeholder' => 'Height in Inches', 'style' => 'width:100%']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Record Height', ['class' => 'btn btn-primary form-control']) !!}
					</div>

				{!! Form::close() !!}
			</div>
		@endif
	</div>
@stop