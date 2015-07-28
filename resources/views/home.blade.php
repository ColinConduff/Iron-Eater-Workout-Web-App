@extends('app')

@section('content')
	<div class="container">
		<div class="well">
			<h1 class="text-center">Iron Eater</h1>
		</div>

		<div class="well text-center">
				<p>A free and easy-to-use weightlifing log</p>
				<p>Optimized for mobile and desktop computers</p>
		</div>
		
		<img src="{{ URL::asset('IronEater.jpg') }}" class="img-responsive center-block" alt="Iron Eater image">
	</div>
@stop