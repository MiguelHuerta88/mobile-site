@extends('layouts.admin')
@section('title','Admin')
@section('content')
<div class='container'>
    <div class='row text-center title-row'>
        <span class='type-title'>{{ $node->title }}</span>
    </div>
    
    {!! Form::open() !!}
    <div class='row'>
        <div class='form-group col-lg-5'>
            {!! Form::label('type', 'Type(about|project|download)') !!}
            <input type='text' name='type' class="form-control {{ $errors->has('type') ? 'error' : '' }}" value='{{ Input::old('type', (isset($node->type)) ? $node->type : '') }}'>
            @if($errors->has('type'))
                <span class="help-block">{{ $errors->first('type') }}</span>@endif
        </div>
    </div>
    <div class='row'>
        <div class='form-group col-lg-5'>
            {!! Form::label('title', 'Title') !!}
            <input type='text' name='title' class="form-control {{ $errors->has('title')}} ? 'error' : '' " value='{{ Input::old('title', (isset($node->title)) ? $node->title : '') }}'>
            @if($errors->has('title'))
                <span class="help-block">{{ $errors->first('title') }}</span>@endif
        </div>
    </div>
    <div class='row'>
        <div class='form-group col-lg-8'>
            {!!  Form::label('body', 'Body') !!}
            <textarea rows="10" name="body" class="form-control {{ $errors->has('body') ? 'error' : '' }}">
                {!! Input::old('body', (isset($nodeType->body)) ? $nodeType->body : '') !!}
            </textarea>
            @if($errors->has('body'))
            <span class='help-block'>{{ $errors->first('body') }}</span>@endif
        </div>
    </div>
    <input type="hidden" name="id" value="{{ $node->id }}"/>
    <button class='btn btn-primary' type='submit'>Submit</button>
    {!! Form::close() !!}
</div>
@endsection

