@extends('app')

@section('content')
	<div class="container">
		<div class="well">
			<h1 class="text-center">Iron Eater</h1>
		</div>
		<div id="getting-started"></div>
		<script type="text/javascript">
			$("#getting-started")
				.countdown("2016/01/01", function(event) {
					$(this).text(
						event.strftime('%M:%S')
							);
			});
		</script>

		<div class="well">
			<ul>
				<li>A free and easy-to-use weightlifing log</li>
				<li>Optimized for mobile and desktop computers</li>
			</ul>
		</div>
		<img src="{{ URL::asset('IronEater.jpg') }}" class="img-responsive center-block" alt="Iron Eater image">
	</div>
@stop