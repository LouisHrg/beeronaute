@extends('layouts.layout')


@section('breadcrumb')
<div class="container feed">
	<div class="row">
		<div class="col-md-12">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item "><a href="{{ route('home') }}">Accueil</a></li>
					<li class="breadcrumb-item"><a href="{{ route('recommendations') }}">Recommandations</a></li>
					<li class="breadcrumb-item active">{{ $reco->title }}</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
@endsection

@section('content')
@include('layouts.navbar')
<div class="banner-div">
	{{ $reco->getFirstMedia('featured-reco') }}
</div>
<div class="container">
	<div class="row mb-5">
		<div class="mx-auto col-md-8">
			<h1> {{ $reco->title }} </h1>
			<p>{!! $reco->body !!}</p>
		</div>
	</div>
	<div class="row mb-5">
		@foreach($reco->bars as $bar)
		<div class="col-md-3 mx-auto">
			<div class="card">
				<div class="img-bar-home">
				{{ $bar->getFirstMedia('featured-bar') }}
				</div>
				<div class="card-body">
				{{ $bar->name }}
				<a target="_blank" href="{{ route('bar-single',$bar->slug) }}" class="btn btn-sm btn-block btn-info"> Découvrir </a>
				</div>

			</div>
		</div>
		@endforeach
	</div>
</div>
@endsection