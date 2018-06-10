@extends ('layouts.layout-admin')

@role('manager')
@include('layouts.navbar-manage')
@endrole
@role('admin')
@include('layouts.navbar-admin')
@endrole

@section('title','Admin | Beeronaute')


@section('breadcrumb')
<div class="container feed">
  <div class="row">
    <div class="col-md-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('manage-home') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('manage-bars') }}">Bar</a></li>
          <li class="breadcrumb-item active" aria-current="page">Ajouter bar</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="block">



        @if ($errors->any())
        <div class="alert alert-dismissible alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        {!! Form::open(['action' => $action, 'method' => $method,'files'=>true ]) !!}
        {{ Form::token() }}


        {{ Form::bsText('name','Nom du bar','Le nom du bar', old('title'),[]) }}

        {{ Form::bsTextLong('description','Description',"Quelque mots pour décrire votre établissement", old('description'),[],"Saisissez une description pour votre bar") }}           


        {{ Form::slug('slug','Lien du bar','Lien', old('slug'),[],"Chemin vers le bar sur le site") }}

        {{ Form::bsText('number','Numéro de téléphone','Numéro', old('number'),[]) }}

        {{ Form::bsText('address','Adresse du bar','Adresse', old('address'),[]) }}

        {{ Form::bsSelect('city', \App\Place::all(),'city','Ville') }}

        
        {{ Form::bsEmail('email','E-mail','Adresse email du bar', old('email'),[]) }}     

        {{ Form::bsFile('image','Photo du bar','Uploader')}}

        {{ Form::schedule('schedule',old('schedule'),'Horraires d\'ouverture') }}

        {{ Form::bsSubmit('Ajouter') }}


        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

@endsection