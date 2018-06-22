@extends('layouts.layout')

@section('breadcrumb')
<div class="container feed">
  <div class="row">
    <div class="col-md-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
          <li class="breadcrumb-item"><a href="{{ route('bars') }}">Bars</a></li>
          <li class="breadcrumb-item active">Mes bars</li>
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
    <div class="mx-auto col-md-12 mt-5">
      <table class="table">
        <thead class="table-dark">
          <tr>
            <th scope="col">Bar</th>
            <th scope="col">Ambiance</th>
            <th scope="col">Ville</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($subs as $sub)

          <tr>
            <td scope="row">{{ ucfirst($sub->place->name) }}</td>
            <td scope="row">{{ ucfirst($sub->place->type->name) }}</td>
            <td scope="row">{{ ucfirst($sub->place->city->name) }}</td>
            <td scope="row"><a class="btn btn-sm btn-secondary" target="_blank" href="{{ route('bar-single',$sub->place->slug) }}"><span class="icon icon-search"></span></a></td>
          </tr>

          @empty
          <tr>
            <td scope="row">Vous ne suivez aucun bar pour le moment </td>
          </tr>
          @endforelse
        </tbody>
        {{ $subs->links() }}
      </table> 
    </div>
  </div>
</div>
@endsection