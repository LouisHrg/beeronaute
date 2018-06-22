@extends('layouts.layout')

@section('breadcrumb')
<div class="container feed">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                    <li class="breadcrumb-item active">Publications</li>
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
        <div class="mx-auto col-md-8">

        @foreach($posts as $post)

        <div class="card feed-element">
                <div class="img-publication-home">
                    {{ $post->getFirstMedia('featured-publication') }}
                </div>
            <div class="card-body">
                <h4 class="card-title">{{ $post->title }}</h4>
                <h6 class="card-subtitle mb-2 text-muted">{{ $post->published->diffForHumans() }}</h6>
                <p class="card-text">{!! $post->content !!}</p>
                <a href="{{ route('publication-single',$post->slug)  }}" class="card-link">Lire la suite...</a>
            </div>
        </div>

        @endforeach
            {{ $posts->links() }}
    </div>
</div>
</div>
@endsection

