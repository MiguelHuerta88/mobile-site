@extends('layouts.master')
@section('title', 'Welcome to Miguelhuerta.co.nf')
@section('content')
<div class='container'>
    <!-- Show the content -->
    @foreach($sections as $index => $section)
        <section class="section">
            <div class="section-title">{{ $section->title }}</div>
            <div class="section-content">
                {!! nl2br($section->nodeType->body) !!}
            </div>
        </section>
        @if($index / 2 == 0)
            <!-- Ad Slot HERE -->
        @endif
    @endforeach
</div>
@endsection