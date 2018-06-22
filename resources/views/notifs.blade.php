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
<div class="container">
    <div class="row">
        <div class="mx-auto col-md-12">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Notifications</th>
              </tr>
          </thead>
          <tbody>
            @forelse($notifs as $notif)

            @if($notif->type == 1 && strtotime($notif->party->startDate) > strtotime(time()))
            <tr>
              <td scope="row"><a href="{{ route('event-single',$notif->party->id) }}">{{ ucfirst($notif->party->name) }} : commence {{ $notif->party->startDate->diffForHumans() }}</a></td>
             </tr>

          @endif

          @empty
          <tr>
              <td scope="row">Aucune notification</td>
          </tr>
          @endforelse
      </tbody>
      {{ $notifs->links() }}
  </table> 
</div>
</div>
</div>
@endsection