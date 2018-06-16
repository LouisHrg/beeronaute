@extends('layouts.layout')

@section('content')
@include('layouts.navbar')
<div class="container feed">
    <div class="row">
        <div class="mx-auto col-md-8">


        <h4> Tous les évenements </h4>
        <div class="form-group">
        <a href="{{ route('events-me') }}" class="btn btn-sm btn-info"> Voir mes évenements </a>
        </div>
        @foreach($events as $event)

        <div class="card feed-element">
                <div class="img-bar-home">{{ $event->getFirstMedia('featured-event') }}</div>
            <div class="card-body">
                <h4 class="card-title">{{ $event->name }}</h4>
                <p class="card-text">{!! $event->body !!}</p>
                <p class="card-text">{{ $event->place->name }}</p>
                <p class="card-text">{{ $event->place->city->name }}</p>
                <a href="{{ route('event-single',$event->id) }}" class="btn btn-sm btn-info">Voir plus</a>
            </div>
        </div>

        @endforeach

        {{ $events->links() }}

    </div>
</div>
</div>
@endsection

