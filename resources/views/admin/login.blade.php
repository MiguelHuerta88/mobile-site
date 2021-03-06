@extends('layouts.master')
@section('title','Login')
@section('content')
<div class='container'>
    <div class='col-lg-6'>
        <h3>Login to your Account</h3>
        {!! Form::open() !!}
            {!! Form::token() !!}

            {{-- we will begin to add our labels --}}
            <div class='form-group'>
                {!! Form::label('username', 'Username:') !!}
                <input type="text" name='username' class="form-control {{ $errors->has('username') ? 'error' : ''}}" value="{{ Input::old('username') }}">
                @if($errors->has('username'))
                    <span class="help-block">{{ $errors->first('username') }}</span>@endif
            </div>
            <div class='form-group'>
                {!! Form::label('password', 'Password:') !!}
                <input type="password" name='password' class="form-control {{ $errors->has('password') ? 'error' : ''}}" value="{{ Input::old('password') }}">
                @if($errors->has('password'))
                    <span class="help-block">{{ $errors->first('password') }}</span>@endif
            </div>

            <button type="submit" class="btn btn-default">Submit</button>
        {!! Form::close() !!}
    </div>
</div>
@endsection