@extends ('layouts.layout-admin')

@include('layouts.navbar-admin')

@section('breadcrumb')
<div class="container feed">
  <div class="row">
    <div class="col-md-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin-home') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin-users-browse') }}">Utilisateurs</a></li>
          <li class="breadcrumb-item active" aria-current="page">Nouvel utilisateur</li>
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


        {!! Form::open(['action' => 'UsersController@saveUser', 'method' => 'post']) !!}
        {{ Form::token() }}


        {{ Form::bsText('name','Nom d\'utilisateur','Le titre', old('name'),[],"Ce nom servira de login à l'utilisatuer") }}

        {{ Form::bsText('firstname','Prénom','Le prénom', old('firstname'),[]) }}

        {{ Form::bsText('lastname','Nom','Le nom', old('lastname'),[]) }}     
        
        {{ Form::bsEmail('email','E-mail','Adresse email', old('email'),[]) }}     
        
        {{ Form::bsSelect('role', \Spatie\Permission\Models\Role::all(),'user','Rôle','kk') }}

        {{ Form::bsPasswordConf('password','Mot de passe',"Mot de passe","Confirmation du mot de passe")}}


        {{ Form::bsSubmit('Ajouter l\'utilisateur') }}



        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
