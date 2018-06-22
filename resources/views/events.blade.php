@extends('layouts.layout')

@section('breadcrumb')
<div class="container feed">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Fil d'actualité</a></li>
                    <li class="breadcrumb-item active">Tous les évenements</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
@include('layouts.navbar')
<div class="container ">
    <div class="row">
        <div class="mx-auto col-md-10">


            <h4>Tous les évenements </h4>
            <div class="form-group">
                <a href="{{ route('events-me') }}" class="btn btn-sm btn-info"> Voir mes évenements </a>
            </div>
            @forelse($events as $event)

            <div class="card feed-element">
                <div class="img-bar-home">{{ $event->getFirstMedia('featured-event') }}</div>
                <div class="card-body">
                    <h4 class="card-title">{{ $event->name }}</h4>
                    <h5 class="card-text">{{ $event->place->city->name }}</h5>
                    <h6 class="card-text">{{ ucfirst($event->place->name) }}</h6>
                    @if(!$event->status)
                    @if(strtotime($event->startDate) > time())
                    <p class="text-muted">Débute {{ $event->startDate->diffForHumans() }}</p>
                    @else
                    <p>Évenement en cours, termine {{ $event->endDate->diffForHumans() }}</p>
                    @endif
                    @else
                    <p>Évenement annulé</p>
                    @endif

                    <a href="{{ route('event-single',$event->id) }}" class="btn btn-sm btn-info">Voir plus</a>
                </div>
            </div>
            @empty
            <div class="col-md-12 text-center">
                <div class="img-ui">
                <img src="{{ asset('img/ui/event.png') }}">
                </div>
            </div>
            <br>
            <div class="col-md-12 text-center">
                <h5> Il n'y aucun évenement ici, essaie de revenir plus tard !</h5>
            </div>
            @endforelse
            {{ $events->links() }}

        </div>
    </div>
</div>
@endsection

