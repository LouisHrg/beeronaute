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
        <div class="mx-auto col-md-8 text-center profile-infos">
            <img class="avatar-profile" src="{{ $user->getFirstMedia('avatar-user')->getUrl() }}">
            <h3> {{ ucfirst($user->name) }}</h3>
            <p> {{ $user->bio }} </p>
            <p> A rejoint beeronaute {{ $user->created_at->diffForHumans() }} </p>
        </div>
    </div>
</div>
@endsection

