@extends('layouts.layout')

@section('breadcrumb')
<div class="container feed">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Fil d'actualité</a></li>
                    <li class="breadcrumb-item active">Toutes les recommandations</li>
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


            <h4>Toutes les recommandations</h4>
            <div class="form-group mt-3 mb-3">
                {!! Form::open(['method'=>'GET','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
                <div class="col-md-12 ml-auto">
                    <div class="form-group row ">
                        <input type="text" class="form-control col-md-11" name="search" id="search" aria-describedby="search" placeholder="Rechercher parmis les recommendations" >
                        <button type="submit" class="btn btn-secondary col-md-1"><span class="icon icon-search"></span></button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="row no-gutters">
                @forelse($items as $item)

                <div class="col-md-12">
                    <div class="container-reco">
                        <div class="image-div">
                            {{ $item->getFirstMedia('featured-reco') }}
                        </div>
                        <a target="_blank" href="{{ route('reco-single',$item->id) }}">
                            <div class="overlay">
                                <div class="text">
                                    <h4>{{ ucfirst($item->title) }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-md-12 text-center">
                    <div class="img-ui">
                        <img src="{{ asset('img/ui/recommendations.png') }}">
                    </div>
                </div>
                <br>
                <div class="col-md-12 text-center">
                    <h5> Il n'y aucune recommendations pour le moment, essaie de revenir plus tard !</h5>
                </div>
                @endforelse
            </div>
            {{ $items->links() }}

        </div>
    </div>
</div>
@endsection

