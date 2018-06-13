@extends('layouts.layout')

@section('content')
@include('layouts.navbar')
<div class="container feed">
    <div class="row">
        <div class="mx-auto col-md-8">

        @foreach($events as $event)

        <div class="card feed-element">
            <div class="card-body">
                <h4 class="card-title">{{ $event->name }}</h4>
                <p class="card-text">{!! $event->body !!}</p>
            </div>
        </div>

        @endforeach

        {{ $events->links() }}

    </div>
</div>
</div>
@endsection

