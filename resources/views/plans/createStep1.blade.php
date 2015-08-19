@extends('app')

@section('content')

	<div class="container">
		@include('errors.list')

		<div class="well">
			<h1>Step 1: Create A New Plan</h1>
		</div>

		<div class="well">
			{!! Form::open(['url' => 'plans']) !!}

			<div class="form-group">
				{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
			</div>

			{{--
			<div class="container">
			    <div class='col-md-5'>
			        <div class="form-group">
			            <div class='input-group date' id='datetimepicker6'>
			                <input type='text' class="form-control" />
			                <span class="input-group-addon">
			                    <span class="glyphicon glyphicon-calendar"></span>
			                </span>
			            </div>
			        </div>
			    </div>
			    <div class='col-md-5'>
			        <div class="form-group">
			            <div class='input-group date' id='datetimepicker7'>
			                <input type='text' class="form-control" />
			                <span class="input-group-addon">
			                    <span class="glyphicon glyphicon-calendar"></span>
			                </span>
			            </div>
			        </div>
			    </div>
			</div>
			<script type="text/javascript">
			    $(function () {
			        $('#datetimepicker6').datetimepicker();
			        $('#datetimepicker7').datetimepicker({
			            useCurrent: false //Important! See issue #1075
			        });
			        $("#datetimepicker6").on("dp.change", function (e) {
			            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
			        });
			        $("#datetimepicker7").on("dp.change", function (e) {
			            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
			        });
			    });
			</script>
			--}}

			<div class="form-group">
				{!! Form::input('date', 'start_date', date('Y-m-d'), ['class' => 'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::input('date', 'end_date', date('Y-m-d'), ['class' => 'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::submit('Got to Step 2', ['class' => 'btn btn-primary form-control']) !!}
			</div>

			{!! Form::close() !!}
		</div>
	</div>
@stop