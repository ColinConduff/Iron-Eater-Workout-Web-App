@extends('app')

@section('content')
<div class="container">
    <h1>Login</h1>
    <hr/>

    <form method="POST" action="/auth/login">

        @include('errors.list')

        {!! csrf_field() !!}

        <div class="form-group">
            <label>Email</label>
            <input class="form-control" type="email" name="email" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input class="form-control" type="password" name="password" id="password">
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember"> 
                Remember Me
            </label>
        </div>

        <button type="submit" class="btn btn-default">Login</button>

    </form>
</div>
@stop
