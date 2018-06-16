@extends('layouts.layout')

@section('content')
@include('layouts.navbar')
<div class="container feed">
    <div class="row">
        <div class="mx-auto col-md-10">


            <h4> Tous mes évenements </h4>
            <div class="form-group">
                <a href="{{ route('events') }}" class="btn btn-sm btn-info"> Voir tous les évenements </a>
            </div>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Date</th>
                  <th scope="col">Nom</th>
                  <th scope="col">Lieu</th>
                  <th scope="col">Ville</th>
                  <th scope="col">Action</th>
              </tr>
          </thead>
          <tbody>
            @foreach($subs as $sub)
            <tr >
              <th scope="row">{{ $sub->party->startDate->diffForHumans() }}</th>
              <td>{{ $sub->party->name }}</td>
              <td><a target="_blank" href="{{ route('bar-single',$sub->party->place->slug) }}">{{ $sub->party->place->name }}</a></td>
              <td><a target="_blank" href="{{ route('bar-single',$sub->party->place->slug) }}">{{ $sub->party->place->city->name }}</a></td>
              <td><a href="{{ route('event-single',$sub->party->id) }}" class="btn btn-sm btn-info">Voir plus</a></td>
          </tr>
  @endforeach
      </tbody>
  </table> 
        {{ $subs->links() }}


</div>
</div>
</div>
@endsection

