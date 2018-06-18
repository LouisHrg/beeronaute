@extends('layouts.layout')

@section('breadcrumb')
<div class="container feed">
  <div class="row">
    <div class="col-md-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Fil d'actualité</a></li>
          <li class="breadcrumb-item"><a href="{{ route('events') }}">Tous les évenements</a></li>
          <li class="breadcrumb-item active">Tous mes évenements</li>
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
    <div class="mx-auto col-md-10">


      <h4> Tous mes évenements </h4>
      <div class="form-group">
        <a href="{{ route('events') }}" class="btn btn-sm btn-info"> Voir tous les évenements </a>
      </div>
      @if($subs->isNotEmpty())
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Commence</th>
            <th scope="col">Nom</th>
            <th scope="col">Lieu</th>
            <th scope="col">Ville</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($subs as $sub)
          @if(strtotime($sub->party->endDate) > time())
          <tr >
            <th scope="row">{{ 'Le '.date('d/m/Y à H:i',strtotime($sub->party->startDate)) }}</th>
            <td>{{ $sub->party->name }}</td>
            <td><a target="_blank" href="{{ route('bar-single',$sub->party->place->slug) }}">{{ $sub->party->place->name }}</a></td>
            <td><a target="_blank" href="{{ route('bar-single',$sub->party->place->slug) }}">{{ $sub->party->place->city->name }}</a></td>
            <td><a href="{{ route('event-single',$sub->party->id) }}" class="btn btn-sm btn-info">Voir plus</a></td>
          </tr>
          @endif
          @endforeach
        </tbody>
      </table> 
      {{ $subs->links() }}
      @else
      <div class="col-md-12 text-center">
      <img src="{{ asset('img/ui/empty3.png') }}">
    </div>
    <div class="col-md-12 text-center">
      <h5> Oups, tu n'as aucun évenement pour l'instant</h5>
    </div>
    @endif

  </div>
</div>
</div>
@endsection

