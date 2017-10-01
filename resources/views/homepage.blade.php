@extends('layouts.master')
@section('title', 'Welcome to Miguelhuerta.co.nf')

@section('gpt_tags')
{{-- This section need to determined which ads to show --}}
<script>
    var width = $(window).width();

    if(width <= 420) {
        // all mobile devices
    } else if(width >= 750) {
        console.log('3 728x90 ads');
    }
</script>
@endsection
@section('content')
<div class='container'>
    <!-- Show the content -->
    @foreach($sections as $index => $section)
        <?php ++$index;?>
        <section class="section">
            <div class="section-title">{{ $section->title }}</div>
            <div class="section-content" id="{{ $section->type }}">
                {!! nl2br($section->nodeType->body) !!}
            </div>
        </section>
        @if($index % 2 == 0)
            <!-- Ad Slot HERE -->
            <div class="slot-holder">
                <div class="ad-slot-728-90">MID SLOT</div>
            </div>
        @endif
    @endforeach
</div>
@endsection