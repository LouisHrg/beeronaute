@extends('layouts.layout')

@section('breadcrumb')
<div class="container feed">
	<div class="row">
		<div class="col-md-12">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item active">Fil d'actualité</li>
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
			@forelse($posts as $post)
			<div id="post{{$post->id}}" class="card feed-element block-feed block-home">
				@if($post->type == 3)
				<div class="img-bar-home"><img src="{{ $post->party->getFirstMedia('featured-event')->getUrl() }}"></div>
				@endif
				<div class="card-body">
					<div class="row">

						<div class="col-md-1">
						<img class="avatar" src="{{ $post->place->getFirstMedia('featured-bar')->getUrl() }}">
						</div>
						<div class="col-md-11">
							@if($post->type == 1)
							<p class="card-text"><a target='_blank' href="{{ route('bar-single',$post->place->slug) }}">{{ ucfirst($post->place->name) }}</a> a écit :</p>							
							<p class="card-text">{{ $post->body }}</p>
							<h6 class="card-subtitle mb-2 text-muted">{{ $post->created_at->diffForHumans() }}</h6>
							
							@endif
							@if($post->type == 2)
							<p class="card-text"><a target='_blank' href="{{ route('bar-single',$post->party->place->slug) }}">{{ ucfirst($post->party->place->name) }}</a> a écit sur <a target="_blank" href="{{ route('event-single',$post->party->id) }}">{{ $post->party->name }}</a> :</p>							
							<p class="card-text">{{ $post->body }}</p>
							<h6 class="card-subtitle mb-2 text-muted">{{ $post->created_at->diffForHumans() }}</h6>
							
							@endif
							@if($post->type == 3)
							<p class="card-text"><a target='_blank' href="{{ route('bar-single',$post->place->slug) }}">{{ ucfirst($post->place->name) }}</a> a créé un nouvel évenement : <a href="{{ route('event-single',$post->party->id) }}">{{ ucfirst($post->party->name) }}</a></p>
							<h6 class="card-subtitle mb-2 text-muted">{{ $post->created_at->diffForHumans() }}</h6>
							<h6> 
								Du {{ date('d/m/Y à H:s',strtotime($post->party->startDate)) }} au {{ date('d/m/Y à H:s',strtotime($post->party->endDate)) }}</h6>
								<h6> <strong>Lieu : </strong>{{ ucfirst($post->party->place->name) }},  {{ ucfirst($post->party->place->city->name) }}</h6>
								<h6> <strong> Participants :</strong> {{ $post->party->subscriptions()->count() }}</h6>
								<a target="_blank" href="{{ route('event-single',$post->party->id) }}" class="btn btn-sm btn-primary btn-block"> Voir plus </a>
								@endif
							</div>
						</div>
					</div>
				</div>
				@empty
				<div class="col-md-12 text-center">
					<div class="img-ui">
						<img src="{{ asset('img/ui/empty.png') }}">
					</div>
				</div>
				<br>
				<div class="col-md-12 text-center">
					<h5> Oups, tu n'as aucun message dans ton fil, essaie de suivre des bars ou des listes pour voir quelque chose ici !</h5>
				</div>
				@endforelse
			</div>
		</div>
		@endsection

