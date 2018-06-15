@extends('layouts.layout')

@section('content')
@include('layouts.navbar')
<div class="container feed">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<a class="btn btn-sm btn-primary" href="{{ route('bar-single',$event->place->slug) }}" > Retour au bar</a>
				@if(\Auth::id() == $event->place->manager)
				<a class="btn btn-sm btn-warning" href="{{ route('manage-event-edit',$event->id) }}" > Modifier l'évenement</a>
				<a class="btn btn-sm btn-danger" href="{{ route('manage-event-edit',$event->id) }}" > Supprimer cet évenement</a>
				@endif
			</div>
			<div class="img-event-single">{{ $event->getFirstMedia('featured-event') }}</div>
			<h1> {{ $event->name }} </h1>
			{{ $event->place->city->name }}
			{{ $event->place->name }}
			{{ $event->place->location }}
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
					@if(\Auth::user()->hasRole('user'))
					@if(Subscription::where('user_id','=',\Auth::id())->where('event',"=",$id)->get()->isNotEmpty())
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
				{!! $event->description !!}

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

					<p>Evenement : {{ $event->name }}</p>
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

	@endsection