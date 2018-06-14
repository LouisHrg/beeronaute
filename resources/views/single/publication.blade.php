@extends('layouts.layout')


@section('breadcrumb')
<div class="container feed">
	<div class="row">
		<div class="col-md-12">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item "><a href="{{ route('home') }}">Accueil</a></li>
					<li class="breadcrumb-item"><a href="{{ route('news') }}">Publications</a></li>
					<li class="breadcrumb-item active">{{ $post->title }}</li>
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
			<div class="img-event-single">
			{{ $post->getFirstMedia('featured-publication') }}
			</div>
			<h1> {{ $post->title }} </h1>
			<p>{!! $post->content !!}</p>
		</div>
	</div>
</div>
@endsection