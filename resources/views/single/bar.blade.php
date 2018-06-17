@extends('layouts.layout')

@section('breadcrumb')
<div class="container feed">
	<div class="row">
		<div class="col-md-12">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
					<li class="breadcrumb-item"><a href="{{ route('bars') }}">Bars</a></li>
					<li class="breadcrumb-item active">{{ ucfirst($bar->name) }}</li>
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
			<div class="card text-white bg-dark">
				<div class="img-bar-home">
					{{ $bar->getFirstMedia('featured-bar') }}
				</div>
				<div class="block-body">
					<div class="row text-center">
						<div class="mx-auto col-md-4">
							<h1 class="text-center">{{ $bar->name }}</h1>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8 mx-auto">
							<p class="text-center sub">{!! $bar->description !!}</p>
						</div>
					</div>
					<div class="row text-center">
						<div class="col-md-4">
							<p> {{ $bar->location }}</p>
							<p><span class="icon icon-pushpin"></span> {{ $bar->city->name }}</p>
							<p >Ambiance : {{ $bar->type->name }}</p>
							<p >Prix : {!! $bar->priceStars() !!}</p>
						</div>
						<div class="col-md-4">
							{!! $bar->printSchedule() !!}
							<br>
							@if($bar->instantScheduleInfo() == 1)
							<strong>Actuellement ouvert</strong>
							@else
							<strong>Actuellement fermé</strong>
							@endif

						</div>
						<div class="col-md-4">
							<p><span class="icon icon-phone"></span> {{ $bar->phone }}</p>
							@isset($bar->email)
							<p><span class="icon icon-mail"></span> {{ $bar->email }}</p>
							@endisset
						</div>
					</div>
					@role('manager')
					@if($bar->manager == \Auth::id())
					<div class="row">
						<div class="text-center mx-auto col-md-12 actions-bar">
							<button type="button" class="btn btn-primary  btn-sm" data-toggle="modal" data-target="#newPostModal">Ajouter un post</button>
							<a target="_blank" href="{{route('manage-event-create')}}" class="btn btn-info btn-sm" >Créer un évenement</a>
							<a target="_blank" href="{{route('manage-bars-edit',$bar->id)}}" class="btn btn-warning btn-sm" >Modifier les informations</a>
						</div>
					</div>
					@endif
					@endrole
					@role('user')
					<div class="row">
						<div class="text-center mx-auto col-md-12 actions-bar">
							@if(!App\Subscription::where('user_id','=',\Auth::id())->where('bar',"=",$bar->id)->get()->isNotEmpty())
							<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#subTobar">Suivre ce bar</button>
							@else
							<a class="btn btn-danger btn-sm" href="">Ne plus suivre ce bar</a>
							@endif
						</div>
					</div>
					@endrole
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					@if($bar->getMedia('gallery-bar')->isNotEmpty())
					<div class="card feed-element block-feed block-home">
						<div class="card-header">Images</div>
						<div class="card-body">
							<div class="row">
								@foreach($bar->getMedia('gallery-bar')->take(4) as $img)
								<div class="col-md-3">
									<div class="bar-single-gallery">
										{{ $img }}
									</div>
								</div>
								@endforeach
								<div class="col-md-12 text-right">
									<br>
									<a href="{{ route('bar-gallery',$bar->slug)}}" class="btn btn-sm btn-secondary"> Voir plus d'image</a>
								</div>
							</div>
						</div>
					</div>
					@endif
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
							<a href="{{ route('bar-events',$bar->slug) }}" class="btn btn-block btn-sm btn-info"> Tout voir </a>
						</div>
					</div>
					@endif
					@if($posts->isNotEmpty())
					<br>
					<br>
					<h4> Messages : </h5>
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