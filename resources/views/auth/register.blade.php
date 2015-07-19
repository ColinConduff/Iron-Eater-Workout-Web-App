@extends('app')

@section('content')
<div class="container">
    <h1>Register</h1>
    <hr/>

    <form class="form-group" method="POST" action="/auth/register">
        
        @include('errors.list')

        {!! csrf_field() !!}

        <div class="form-group">
            <label>Name</label>
            <input class="form-control" type="text" name="name" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input class="form-control" type="email" name="email" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input class="form-control" type="password" name="password">
        </div>

        <div class="form-group">
            <label>Confirm Password</label>
            <input class="form-control" type="password" name="password_confirmation">
        </div>

        <div>
            <button class="btn btn-default" type="submit">Register</button>
        </div>
    </form>
</div>
@stop