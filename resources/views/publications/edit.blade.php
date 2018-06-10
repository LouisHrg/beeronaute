@extends ('layouts.layout-admin')

@include('layouts.navbar-admin')

@section('title','Admin | Beeronaute')

@section('breadcrumb')
<div class="container feed">
  <div class="row">
    <div class="col-md-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin-home') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin-publications-browse') }}">Publications</a></li>
          <li class="breadcrumb-item active" aria-current="page">Editer une publication (#{{ $post->id }})</li>
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


        {!!Form::open(['action' => ['AdminController@updatePublication',Request::route('id')],'method'=>"POST"]) !!}
        {{ Form::token() }}


        {{ Form::bsText('title','Titre','Le titre', $post->title,[],"Le titre de l'article") }}

        {{ Form::trumbo('content','Contenu', $post->content,[],"Le contenu de l'article") }}           

        {{ Form::bsDate('published', date('d/m/Y H:i',strtotime($post->published)), "Date de publication" , "La date de publication de l'article")}}


        {{ Form::slug('slug','Slug','Slug', $post->slug,[],"Chemin vers l'article sur le site") }}

        {{ Form::bsFile('featured','Image mise en avant','Uploader')}}
        
        {{ Form::bsSubmit('Publier') }}


        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
