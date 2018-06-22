@extends('layouts.layout')

@section('breadcrumb')
<div class="container feed">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Fil d'actualité</a></li>
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
            <div class="form-group mt-3 mb-3">
                {!! Form::open(['method'=>'GET','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
                <div class="col-md-12 ml-auto">
                    <div class="form-group row ">
                        <input type="text" class="form-control col-md-11" name="search" id="search" aria-describedby="search" placeholder="Rechercher parmis less recommendations" >
                        <button type="submit" class="btn btn-secondary col-md-1"><span class="icon icon-search"></span></button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
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

