@extends('layouts.layout')

@section('content')
@include('layouts.navbar')
<div class="container feed">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<a class="btn btn-sm btn-primary" href="{{ route('bar-single',$event->place->slug) }}" > Retour au bar</a>
				@if(\Auth::id() == $event->place->manager)
				<button class="btn btn-sm btn-info" data-toggle="modal" data-target="#newPostModal"  > Poster un message</button>
				<a class="btn btn-sm btn-success" href="{{ route('manage-event-edit',$event->id) }}" > Modifier l'évenement</a>
				<a class="btn btn-sm btn-warning" href="{{ route('manage-event-edit',$event->id) }}" > Annuler cet évenement</a>
				<a class="btn btn-sm btn-danger" href="{{ route('manage-event-edit',$event->id) }}" > Supprimer cet évenement</a>
				@endif
			</div>
			<div class="img-event-single"><img src="{{ $event->getFirstMedia('featured-event')->getUrl() }}"></div>
			
			<h1> {{ $event->name }} </h1>
			@if(!$event->canceled)
			@if( strtotime($event->endDate) > time())
			@if( strtotime($event->startDate) > time())
			<p>Débute {{ $event->startDate->diffForHumans() }}</p>
			@else
			<p>Évenement en cours, termine {{ $event->endDate->diffForHumans() }}</p>
			@endif
			<div class="row">
				@if(\Auth::user()->hasRole('user'))
				<div class="col-md-10">
					@else
					<div class="col-md-12">
						@endif
						<div class="progress">
							<div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ $event->subscriptions()->count() }}" aria-valuemin="0" aria-valuemax="{{ $event->slot }}" style="width: {{ $event->subscriptions()->count()/ $event->slot*100 }}%"></div>
						</div>
						<p class="text-muted">Il reste {{$event->slot-$event->subscriptions()->count()}} places </p> 
					</div>
					@if(\Auth::user()->hasRole('user') && $event->subscriptions()->count() != $event->slot )
					@if(!$participate)
					<div class="col-md-2">
						<button data-toggle="modal" data-target="#signupModal" class="btn btn-info btn-sm btn-block"> S'incrire </button>
					</div>
					@else
					<div class="col-md-2">
						<button data-toggle="modal" data-target="#signdownModal" class="btn btn-danger btn-sm btn-block"> Annuler l'inscription </button>
					</div>
					@endif
					@endif
				</div>
				<p><strong>Description : </strong></p>
				{!! $event->description !!}
				<br>
				<br>
				<br>
			<p><strong>Ville :</strong> {{ $event->place->city->name }}</p>
			<p><strong>Lieu :</strong> <a target="_blank" href="{{ route('bar-single',$event->place->slug) }}">{{ $event->place->name }}</a></p>
			<p><strong>Adresse :</strong> {{ $event->place->location }}</p>
			@else
			<h4> L'évenement est terminé </h4>
			@endif
			@else
			<h4> L'évenement a été annulé </h4>
			@endif
				<div class="card feed-element block-feed block-home feed">
					<div class="card-header">Participants</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
								@forelse(App\Subscription::where('event','=',$event->id)->get() as $sub)
								<div class="col-md-2">
									<a target="_blank" href="{{ route('profile',$sub->user->name) }}">
										<img src="{{ Auth::user()->getFirstMedia('avatar-user')->getUrl() }}" class="avatar">
										<span class="text-muted"> {{ ucfirst($sub->user->name) }}</span>
									</a>
								</div>
								@empty
								<div class="col-md-12">
								<p> Aucun participant </p>
								</div>
								@endforelse

								</div>
							</div>
						</div>
					</div>
				</div>

				<br><br><br>
				@if($posts->isNotEmpty())
				<h5> Messages : </h5>
				@endif
				@foreach($posts as $post)

				<div id="post{{$post->id}}" class="card feed-element block-feed block-home">
					<div class="card-body">
						<div class="row">
							<div class="col-md-1">
								<img class="avatar" src="/storage/{{ $post->user->avatar }}">
							</div>
							<div class="col-md-11">
								<p class="text-muted">{{ ucfirst($post->user->name) }} dit : </p>
								<p class="card-text">{{ $post->body }}</p>
								<h6 class="card-subtitle mb-2 text-muted">{{ $post->created_at->diffForHumans() }}</h6>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>	
	
	@role('user')
	<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Confirmation d'inscription</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					{!! Form::open(['action' => ['SubscriptionsController@attachEvent',$event->id], 'method' => 'POST','files'=>false ]) !!}
					{{ Form::token() }}

					<p>Évenement : {{ $event->name }}</p>
					<p>Lieu : {{ $event->place->location }}, {{ $event->place->name }}</p>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
					<button type="submit" class="btn btn-primary">Confirmer</button>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
	<div class="modal fade" id="signdownModal" tabindex="-1" role="dialog" aria-labelledby="signdownModal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Annuler votre participation</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					{!! Form::open(['action' => ['SubscriptionsController@dettachEvent',$event->id], 'method' => 'POST','files'=>false ]) !!}
					{{ Form::token() }}

					<p>Evenement : {{ $event->name }}</p>
					<p>Lieu : {{ $event->place->location }}, {{ $event->place->name }}</p>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
					<button type="submit" class="btn btn-danger">Confirmer</button>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
	@endrole


	@role('manager')
	<div class="modal fade" id="newPostModal" tabindex="-1" role="dialog" aria-labelledby="newPostModal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Nouveau post</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					{!! Form::open(['action' => ['PostsController@savePostEvent',$event->id], 'method' => 'POST','files'=>false ]) !!}
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

	@endsection