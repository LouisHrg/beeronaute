@extends('layouts.layout')

@section('content')
@include('layouts.navbar')
<div class="container feed">
<h1> {{ $post->title }} </h1>
<p>{!! $post->content !!}</p>
{{-- <img src="{{ $post->getMedia('images')->first()->getUrl() }}"> --}}
{{ $post->getFirstMedia() }}
</div>
@endsection