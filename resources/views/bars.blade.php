@extends('layouts.layout')

@section('breadcrumb')
<div class="container feed">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                    <li class="breadcrumb-item active">Bars</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
@include('layouts.navbar')
<div class="container">
    <div class="row">
        <div class="mx-auto col-md-12">

        <div class="row">
        @foreach($bars as $bar)
        <div class="col-md-4">
        <div class="card feed-element">
                <div class="img-bar-home">
                    {{ $bar->getFirstMedia('featured-bar') }}
                </div>
            <div class="card-body">
                <h4 class="card-title">{{ $bar->name }}</h4>
                <h6>{{ $bar->city->name }}</h6>
                <p class="text-muted">Ambiance : {{ $bar->type->name }}</p>
                <p class="text-muted">Prix : {!! $bar->priceStars() !!}</p>
                <a href="{{ route('bar-single',$bar->slug)  }}" class="card-link">Voir plus</a>
            </div>
        </div>
        </div>
        @endforeach
        </div>

        {{ $bars->links() }}

    </div>
</div>
</div>
@endsection

