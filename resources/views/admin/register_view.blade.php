@extends('layouts.admin')
@section('title','Register')
@section('content')
<div class='container'>
    <h3>Register Your Admin Account</h3>
    {!! Form::open() !!}
        {!! Form::token() !!}
        
        {{-- we will begin to add our labels --}}
        <div class='form-group'>
            {!! Form::label('name', 'Name:') !!}
            <input type="text" name='name' class="form-control {{ $errors->has('name') ? 'error' : ''}}" value="{{ Input::old('name') }}">
            @if($errors->has('name'))
                <span class="help-block">{{ $errors->first('name') }}</span>@endif
        </div>
        <div class='form-group'>
            {!! Form::label('last_name', 'Lastname:') !!}
            <input type="text" name='last_name' class="form-control {{ $errors->has('last_name') ? 'error' : ''}}" value="{{ Input::old('name') }}">
            @if($errors->has('last_name'))
                <span class="help-block">{{ $errors->first('last_name') }}</span>@endif
        </div>
        <div class='form-group'>
            {!! Form::label('username', 'Username:') !!}
            <input type="text" name='username' class="form-control {{ $errors->has('username') ? 'error' : ''}}" value="{{ Input::old('username') }}">
            @if($errors->has('username'))
                <span class="help-block">{{ $errors->first('username') }}</span>@endif
        </div>
        <div class='form-group'>
            {!! Form::label('email', 'Email:') !!}
            <input type="text" name='email' class="form-control {{ $errors->has('email') ? 'error' : ''}}" value="{{ Input::old('email') }}">
            @if($errors->has('email'))
                <span class="help-block">{{ $errors->first('email') }}</span>@endif
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
@endsection

