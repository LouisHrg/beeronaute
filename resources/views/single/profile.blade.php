@extends('layouts.layout')

@section('breadcrumb')
<div class="container feed">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                    <li class="breadcrumb-item active">Profil de {{ ucfirst($user->name) }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
@include('layouts.navbar')
<img class="banner" src="{{ $user->getFirstMedia('banner-user')->getUrl() }}">
<div class="container">
    <div class="row">
        <div class="mx-auto col-md-8 text-center profile-infos mb-2">
            <img class="avatar-profile" src="{{ $user->getFirstMedia('avatar-user')->getUrl() }}">
            <h3> {{ ucfirst($user->name) }}</h3>
            <p> {{ $user->bio }} </p>
            <p> A rejoint beeronaute {{ $user->created_at->diffForHumans() }} </p>
        </div>
    </div>    
    <div class="row">
        <div class="mx-auto col-md-8 text-center mb-5">
            <h5 class="mb-3"> Les bars que je suis : </h5>
            <div class="row">
                @forelse($subs as $sub)
                <div class="col-md-3 mx-auto">
                    <div class="card">
                        <div class="img-bar-home">
                            {{ $sub->place->getFirstMedia('featured-bar') }}
                        </div>
                        <div class="card-body">
                            {{ $sub->place->name }}
                            <a target="_blank" href="{{ route('bar-single',$sub->place->slug) }}" class="btn btn-sm btn-block btn-info"> Découvrir </a>
                        </div>

                    </div>
                </div>
                @empty
                <p> {{ ucfirst($user->name) }} ne suit pas encore de bar </p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

