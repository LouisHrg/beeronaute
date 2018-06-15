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
<div class="container">
    <div class="row">
        <div class="mx-auto col-md-8">
            <img class="avatar" src="/storage/{{ $user->avatar }}">

    </div>
</div>
</div>
@endsection

