@extends ('layouts.layout-admin')

@include('layouts.navbar-admin')

@section('breadcrumb')
<div class="container feed">
	<div class="row">
		<div class="col-md-12">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('admin-home') }}">Dashboard</a></li>
					<li class="breadcrumb-item active">Utilisateurs</li>
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
				<div class="col-md-7">

				@if (null !== app('request')->input('search'))
				<a href="{{ Request::url() }}" class="btn btn-info"><- Voir tous les éléments </a>
				@endif

				</div>
				{!! Form::open(['method'=>'GET','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
				<div class="col-md-5 ml-auto">
					<div class="form-group row ">
						<input type="text" class="form-control col-md-9" name="search" id="search" aria-describedby="search" placeholder="Rechercher parmis les publications" >
						<button type="submit" class="btn btn-secondary col-md-3">Rehercher</button>
					</div>
				</div>
				{!! Form::close() !!}
				
				<table class="table table-hover ">
					<thead class="thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nom Prénom</th>
							<th scope="col">Username</th>
							<th scope="col">Rôle</th>
							<th scope="col">Email</th>
							<th scope="col" class="w-15">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($items as $item)

						<tr>
							<th scope="row">{{ $item->id }}</th>
							<td scope="row">{{ strtoupper($item->lastname) }} {{ $item->firstname }}</td>
							<td scope="row">{{ $item->name }}</td>
							<td scope="row">{{ $item->roles->first()->name }}</td>
							<td scope="row">{{ $item->email }}</td>
							<td scope="row">
								<a href="{{ route('profile',$item->name) }}/" target="_blank" class="btn btn-info btn-sm"><span class="icon icon-binoculars"></a>
								<a href="{{ route('admin-users-edit',$item->id)}}" class="btn btn-success btn-sm"><span class="icon icon-wrench"></a>
										<button class="btn btn-danger btn-sm" 
												data-toggle="modal" 
												data-target="#deleteUserModal" 
												data-url="{{ route('admin-users-delete',$item->id) }}" 
												data-name="{{ $item->name }}" 
												data-toggle="modal" data-target="#exampleModal"><span class="icon icon-bin"></button>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<div class="text-xs-center ml-auto">
					{{ $items->links() }}
				</div>
								@if($items->total() != 0)
				{{ $items->count() }}/{{ $items->total() }} éléments
				@endif
				


			</div>
		</div>
	</div>
</div>

					<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModal" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="deleteUserModal">Supprimer l'utilisateur'</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form id="form-delete" method="POST" action="" accept-charset="UTF-8">
										{{ Form::token() }}
										Voulez vous vraiment supprimer cet utilisateur ? 
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
