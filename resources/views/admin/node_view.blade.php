@extends('layouts.admin')
@section('title','Admin')
@section('content')
<div class='container'>
    <div class='row text-center title-row'>
        <span class='type-title'>{{ $node->title }}</span>
    </div>
    
    {!! Form::open(['url' => '/admin/edit/submit']) !!}
    <div class='row'>
        <div class='form-group col-lg-5'>
            {!! Form::label('type', 'Type (about | project | download)') !!}
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
            <textarea id='body' rows="10" name="body" class="form-control {{ $errors->has('body') ? 'error' : '' }}">
                {!! Input::old('body', (isset($node->nodeType->body)) ? $node->nodeType->body : '') !!}
            </textarea>
            @if($errors->has('body'))
            <span class='help-block'>{{ $errors->first('body') }}</span>@endif
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-6 pull-right">
        <a id='view-link' class="new-co" data-toggle="modal" data-target='#myModal'>View Changes</a>
    </div>
    </div>
    <input type="hidden" name="id" value="{{ $node->id }}"/>
    <button class='btn btn-primary' type='submit'>Submit</button>
    {!! Form::close() !!}
</div>
@endsection

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Current Changes</h4>
      </div>
      <div class="modal-body">
          <p class='content-body'>
              
          </p>
      </div>
    </div>
  </div>
</div>
