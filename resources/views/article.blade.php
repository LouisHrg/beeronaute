@extends('layouts.layout-home')


@section('content')

@include('layouts.navbar-blog')
				<img class="banner" src="{{ $article->getFirstMedia('featured-publication')->getUrl() }}">
<div class="container feed">
	<div class="row">
		<div class="col-md-12 mx-auto">
			<div class="row">
				<a href="{{ route('blog') }}" class="btn btn-sm btn-secondary">Accueil</a>
				<div class="col-md-12">
				<h1>{{ $article->title }}</h1>
				<p class="text-muted">Publié {{ $article->published->diffForHumans() }}</p>
				{!! $article->content !!}
				</div>
			</div>		
		</div>
	</div>	

</div>

@endsection
