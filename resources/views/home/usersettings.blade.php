@extends ('layouts.layout')

@include('layouts.navbar')

@section('breadcrumb')
<div class="container feed">
  <div class="row">
    <div class="col-md-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin-home') }}">Accueil</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin-users-browse') }}">Mon profil</a></li>
          <li class="breadcrumb-item active" aria-current="page">Paramètres</li>
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


        {!!Form::open(['action' => ['UsersController@updateUserProfile'],'method'=>"POST",'files'=>true]) !!}
        {{ Form::token() }}

        {{ Form::bsText('firstname','Prénom','Le prénom', $user->firstname,[]) }}

        {{ Form::bsText('lastname','Nom','Le nom', $user->lastname,[]) }} 

        {{ Form::bsTextLong('bio','Bio','Votre histoire', $user->bio,[]) }}     

        {{ Form::bsPasswordConf('password','Mot de passe',"Mot de passe","Confirmation du mot de passe",false)}}

        <img class="banner" src="{{ $user->getFirstMedia('banner-user')->getUrl() }}">
        {{ Form::bsFile('banner','Image mise en avant','Uploader')}}
        
        <img class="avatar-profile" src="{{ $user->getFirstMedia('avatar-user')->getUrl() }}">
        {{ Form::bsFile('avatar','Image mise en avant','Uploader')}}
        

        {{ Form::bsSubmit('Modifier l\'utilisateur') }}

        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
