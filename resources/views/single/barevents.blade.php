@extends('layouts.layout')

@section('breadcrumb')
<div class="container feed">
	<div class="row">
		<div class="col-md-12">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
					<li class="breadcrumb-item"><a href="{{ route('bars') }}">Bars</a></li>
					<li class="breadcrumb-item "><a href="{{ route('bar-single',$bar->slug)}}">{{ ucfirst($bar->name) }}</a></li>
					<li class="breadcrumb-item active">Tous les évenements</li>
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
			<a href="{{ route('bar-single',$bar->slug) }}" class="btn btn-sm btn-info"> Retour au bar </a>
			
				@if($events->isNotEmpty())
				<div class="card feed-element block-feed block-home">
					<div class="card-header">Evenements</div>
					<div class="card-body">
						@foreach($events as $event)
						<div class="row">
							<div class="col-md-4">
								<div class="img-bar-home-event">
									{{ $event->getFirstMedia('featured-event') }}
								</div>
							</div>
							<div class="col-md-8">
								<h5 class="card-title">{{ $event->name }}</h5>
								<h6 class="card-subtitle mb-2 text-muted">Publié {{ $event->published->diffForHumans() }}</h6>
								<p class="text-muted">Du {{ date('d/m/Y H:i',strtotime($event->startDate)).' au '.date('d/m/Y H:i',strtotime($event->endDate)) }}</p>
								@if(\App\Subscription::where('user_id','=',\Auth::id())->where('event',"=",$event->id)->get()->isNotEmpty())
								Vous êtes inscrit
								@endif
								<div class="row">
									<div class="col-md-8">
										<div class="progress">
											<div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ $event->subscriptions()->count() }}" aria-valuemin="0" aria-valuemax="{{ $event->slot }}" style="width: {{ $event->subscriptions()->count()/ $event->slot*100 }}%"></div>
										</div>
										<p class="text-muted">Il reste {{$event->slot-$event->subscriptions()->count()}} places </p>
										<br>			
									</div>
									<div class="col-md-4">
										<a href="{{ route('event-single',$event->id) }}" class="btn btn-primary btn-sm btn-block"> Voir plus </a>
									</div>
								</div>
							</div>
						</div>
						@endforeach
					{{ $events->links() }}
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>

	@role('manager')
	<div class="modal fade" id="newPostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Nouveau post</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					{!! Form::open(['action' => ['PostsController@savePost',$bar->id], 'method' => 'POST','files'=>false ]) !!}
					{{ Form::token() }}
					{{ Form::bsTextLong('body','Message',"", old('description'),[],"Saisissez votre message") }}           

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
					<button type="submit" class="btn btn-primary">Ajouter !</button>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
	@endrole

	@role('user')
	<div class="modal fade" id="subTobar" tabindex="-1" role="dialog" aria-labelledby="subTobar" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="subTobar">Suivre ce bar ?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					{!! Form::open(['action' => ['SubscriptionsController@attachBar',$bar->id], 'method' => 'POST','files'=>false ]) !!}

					{{ Form::token() }}
					Voulez vous vraiment suivre ce bar ? Tous les évenements et les messages apparaitront dans votre fil d'actualité. 


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
					<button type="submit" class="btn btn-primary">Let's go !</button>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
	@endrole

	@endsection