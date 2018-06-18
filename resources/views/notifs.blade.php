@extends('layouts.layout')

@section('breadcrumb')
<div class="container feed">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                    <li class="breadcrumb-item active">Toutes mes notifications</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
@include('layouts.navbar')
<div class="container feed">
    <div class="row">
        <div class="mx-auto col-md-8">
            @foreach($notifs as $notif)

            @if($notif->type == 1 && strtotime($notif->party->startDate) > strtotime(time()))
            <a href="{{ route('event-single',$notif->party->id) }}">{{ ucfirst($notif->party->name) }} : commence {{ $notif->party->startDate->diffForHumans() }}</a>
            @endif
            @endforeach
        </div>
    </div>
</div>
@endsection