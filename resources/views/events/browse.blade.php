@extends ('layouts.layout-admin')

@role('manager')
@include('layouts.navbar-manage')
@endrole
@role('admin')
@include('layouts.navbar-admin')
@endrole

@section('breadcrumb')
<div class="container feed">
	<div class="row">
		<div class="col-md-12">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					@role('manager')
					<li class="breadcrumb-item"><a href="{{ route('manage-home') }}">Dashboard</a></li>
					@endrole
					@role('admin')
					<li class="breadcrumb-item"><a href="{{ route('admin-home') }}">Dashboard</a></li>
					@endrole
					<li class="breadcrumb-item active">Evenements</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
@endsection

@section('content')
<div class="container ">
	<div class="row">
		<div class="col-md-12">
			<div class="block">
				<div class="col-md-12">
					@role('manager')
					<a class="btn btn-success" href="{{ route($newAction)}}"> Ajouter un évenement </a>
					@endrole
				</div>
				@if (null !== app('request')->input('search'))
				<a href="{{ Request::url() }}" class="btn btn-info"><- Voir tous les éléments </a>
				@endif

				{!! Form::open(['method'=>'GET','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
				<div class="col-md-5 ml-auto">
					<div class="form-group row ">
						<input type="text" class="form-control col-md-9" name="search" id="search" aria-describedby="search" placeholder="Rechercher parmis les publications" >
						<button type="submit" class="btn btn-secondary col-md-3">Rehercher</button>
					</div>
				</div>
				{!! Form::close() !!}
				<br>
				<table class="table table-hover">
					<thead class="thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nom de l'évenement</th>
							<th scope="col">Nombre d'inscrit</th>
							<th scope="col">Début</th>
							<th scope="col">Date de publication</th>
							@role('admin')
							<th scope="col">Auteur</th>
							@endrole
							<th scope="col">Lieu</th>
							<th scope="col">Status</th>
							<th scope="col" class="w-20">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($items as $item)

						<tr>
							<th scope="row">{{ $item->id }}</th>
							<td scope="row">{{ $item->name }}</td>
							<td scope="row">{{ $item->subscriptions()->count() }}/{{$item->slot}}</td>
							<td scope="row">{{ date('l m (H:i)', strtotime($item->startDate)) }}</td>
							<td scope="row">{{ date('d/m/Y H:i',strtotime($item->endDate)) }}</td>
							@role('admin')
							<td scope="row">{{ $item->user->name }}</th>
								@endrole
								<td scope="row">
									<a target="_blank" href="/bar/{{ $item->place->slug }}">{{ $item->place->name }}</a>
								</td>
								<td scope="row">{{ $item->canceled==1?"Annulé":"RAS" }}</th>
								<td scope="row">
									<a href="{{ route('event-single',$item->id) }}" target="_blank" class="btn btn-info btn-sm"><span class="icon icon-binoculars"></a>
										<a href="{{ route($editAction,$item->id)}}" class="btn btn-success btn-sm"><span class="icon icon-wrench"></a>
											@if($item->canceled==0)
											<button class="btn btn-warning btn-sm" 
												data-toggle="modal" 
												data-target="#cancelEventModal" 
												data-url="{{ route('event-cancel',$item->id) }}" 
												data-name="{{ $item->name }}" 
												data-toggle="modal" data-target="#cancelEventModal"><span class="icon icon-cross"></button>
											@endif
												<button class="btn btn-danger btn-sm" 
												data-toggle="modal" 
												data-target="#deleteEventModal" 
												data-url="{{ route('event-delete',$item->id) }}" 
												data-name="{{ $item->name }}" 
												data-toggle="modal" data-target="#exampleModal"><span class="icon icon-bin"></button>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>

									{{ $items->links() }}
								</div>
							</div>
						</div>
					</div>


					<div class="modal fade" id="deleteEventModal" tabindex="-1" role="dialog" aria-labelledby="deleteEventModal" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="deleteEventModal">Supprimer l'évenement</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form id="form-delete" method="POST" action="" accept-charset="UTF-8">
										{{ Form::token() }}
										Voulez vous vraiment supprimer cet évenemnt ? Cette action est irreversible
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
										<button type="submit" class="btn btn-danger">Confirmer</button>
									</div>
								</form>  
								
							</div>
						</div>
					</div>

					<div class="modal fade" id="cancelEventModal" tabindex="-1" role="dialog" aria-labelledby="cancelEventModal" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="cancelEventModal">Annuler l'évenement</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form id="form-delete" method="POST" action="" accept-charset="UTF-8">
										{{ Form::token() }}
										Voulez vous vraiment annuler cet évenement ? Cette action est irréversible.
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
										<button type="submit" class="btn btn-danger">Confirmer</button>
									</div>
								</form>  
								
							</div>
						</div>
					</div>
					@endsection