@extends('layouts.layout')

@section('content')
@include('layouts.navbar')
<div class="container feed">
    <div class="row">
        <div class="mx-auto col-md-8">

        @foreach($posts as $post)

        <div class="card feed-element">
            <div class="card-body">
                <h4 class="card-title">{{ $post->title }}</h4>
                <h6 class="card-subtitle mb-2 text-muted">{{ $post->published }}</h6>
                <p class="card-text">{!! $post->content !!}</p>
                <a href="#" class="card-link">Lire la suite...</a>
            </div>
        </div>

        @endforeach

    </div>
</div>
</div>
@endsection

