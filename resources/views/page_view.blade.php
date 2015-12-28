@extends('layouts.master')
@section('title', 'Welcome to Miguelhuerta.co.nf')
@section('content')
<div class='container'>
    <h3>{{ $node->title }}{{--<span class='span-type'>{{ $node->type }}--}}</span></h3>
    <p>
        @if($node->nodeType)
            {!! nl2br($node->nodeType->body) !!}
        @endif
    </p>
    </div>
@endsection
