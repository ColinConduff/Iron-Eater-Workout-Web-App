@extends('app')

@section('content')
	<div class="container">
		<div>@include('errors.list')</div>

		<a href="{{ url('showLog') }}" class="btn btn-default btn-block" style="margin-bottom:1em">
			Return to Log
		</a>

		@if(count($currentSessions))
			<div class="well">
				
				@foreach ($currentSessions as $session)
					
					<div class="text-center">
						<h4>{{ $session->exercise->title }}</h4>
					</div>
					
					<div class="row">

						{!! Form::model($session, ['method' => 'PATCH', 'action' => ['SessionController@update', $session->id]]) !!}

						    <div class="col-sm-4 col-xs-12 form-group">
							    {!! Form::select('id', $exerciseList, null, ['class' => 'form-control', 'style' => 'width:100%']) !!}
							</div>

							<div class="col-sm-4 col-xs-6 form-group">
								{!! Form::submit('Update Session', ['class' => 'btn btn-primary form-control']) !!}
							</div>
						{!! Form::close() !!}

						<div class="col-sm-4 col-xs-6 text-center">
							{!! Form::open(array('url' => 'sessions/' . $session->id)) !!}
			                    {!! Form::hidden('_method', 'DELETE') !!}
			                    {!! Form::button('Delete Session', array('type' => 'submit', 'class' => 'btn btn-danger', 'style' => 'width:100%')) !!}
			                {!! Form::close() !!}
		                </div>
		            </div>
					@if( $session->sessionSets->count() )
						@foreach ($session->sessionSets as $index => $sessionSet)
							<div class="row">

								<div class="col-xs-2 col-sm-4 col-md-4 text-center">{{ $index+1 }}</div>

								{!! Form::model($sessionSet, ['method' => 'PATCH', 'action' => ['SessionSetController@update', $sessionSet->id]]) !!}
								<div class="col-xs-5 col-sm-4 col-md-4 form-group">
									{!! Form::text('number_of_reps', $sessionSet->number_of_reps, ['class' => 'form-control']) !!}
								</div>

								<div class="col-xs-5 col-sm-4 col-md-4 form-group">
									{!! Form::text('weight_lifted', $sessionSet->weight_lifted, ['class' => 'form-control']) !!}
								</div>

								<div class="col-xs-5 col-xs-offset-2 col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4 form-group">
									{!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
								</div>
								{!! Form::close() !!}

								<div class="col-xs-5 col-sm-4 col-md-4">
									{!! Form::open(array('url' => 'sessionSets/' . $sessionSet->id)) !!}
					                    {!! Form::hidden('_method', 'DELETE') !!}
					                    {!! Form::button('Delete Set', array('type' => 'submit', 'class' => 'btn btn-danger', 'style' => 'width:100%')) !!}
					                {!! Form::close() !!}
				                </div>
							</div>
						@endforeach
					@endif
				@endforeach
			</div>
		@endif
	</div>
@stop