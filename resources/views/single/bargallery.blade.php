@extends('layouts.layout')

@section('breadcrumb')
<div class="container feed">
	<div class="row">
		<div class="col-md-12">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Bars</a></li>
					<li class="breadcrumb-item"><a href="{{ route('bar-single',$bar->slug) }}">{{ $bar->name }}</a></li>
					<li class="breadcrumb-item active">Galerie</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
@endsection
@section('content')
@include('layouts.navbar')
<div class="container">
	<div class="row ">
		<div class="mx-auto col-md-10">
			<div class="card text-black bg-light">
				<div class="img-bar-home">
					{{ $bar->getFirstMedia('featured-bar') }}
					<h1 class="text-center">{{ $bar->name }}</h1>
					<h6 class="text-center">Galerie d'image</h6>
				</div>
			</div>
			@if($bar->getMedia('gallery-bar')->isNotEmpty())
			<div class="card feed-element block-feed block-home">
				<div class="card-header">Images</div>
				<div class="card-body">
					<div class="row">
						@foreach($bar->getMedia('gallery-bar') as $img)
						<div class="col-md-4">
							<div class="bar-gallery">
								{{ $img }}
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
			@endif			
		</div>
	</div>
</div>
@endsection