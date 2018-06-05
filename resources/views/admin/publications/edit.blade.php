@extends ('layouts.layout-admin')

@section('content')
@include('layouts.navbar-admin')
<div class="container feed">
  <div class="row">
    <div class="col-md-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="#">Publications</a></li>
          <li class="breadcrumb-item active" aria-current="page">Nouvelle publication</li>
        </ol>
      </nav>
    </div>
  </div>
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


        {!! Form::open() !!}
        {{ Form::token() }}


        {{ Form::bsText('title','Titre','Le titre', $post->title,[],"Le titre de l'article") }}

        {{ Form::trumbo('content','Contenu', $post->content,[],"Le contenu de l'article") }}           

        {{ Form::date('published', \Carbon\Carbon::now()) }}

        {{ Form::slug('slug','Slug','Slug', $post->slug,[],"Chemin vers l'article sur le site") }}

        {{ Form::bsFile('featured','Image mise en avant','Uploader')}}
        
        {{ Form::bsSubmit('Publier') }}


        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
