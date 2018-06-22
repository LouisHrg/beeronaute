@extends ('layouts.layout-admin')

@role('moderator')
@include('layouts.navbar-moderator')
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
          <li class="breadcrumb-item"><a href="{{ route('admin-home') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin-publications-browse') }}">Publications</a></li>
          <li class="breadcrumb-item active" aria-current="page">Nouvelle publication</li>
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


        {!! Form::open(['action' => 'PublicationsController@savePublication', 'method' => 'post','files'=>true]) !!}
        {{ Form::token() }}


        {{ Form::bsText('title','Titre','Le titre', old('title'),[],"Le titre de l'article") }}

        {{ Form::trumbo('content','Contenu', old('content'),[],"Le contenu de l'article") }}           

        {{ Form::bsDate('published', date('d/m/Y H:i'), "Date de publication" , "La date de publication de l'article")}}

        {{ Form::slug('slug','Lien de la publication','Lien', old('slug'),[],"Chemin vers le bar sur le site") }}


        {{ Form::bsFile('featured','Image mise en avant','Uploader')}}
        
        {{ Form::bsSubmit('Publier') }}


        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
