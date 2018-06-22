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