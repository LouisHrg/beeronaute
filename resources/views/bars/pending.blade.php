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
					<li class="breadcrumb-item active">Bars</li>
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
					<a class="btn btn-success" href="{{ route('admin-bars')}}"> Tous les bar </a>
				</div>
				<br>
				<table class="table table-hover">
					<thead class="thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nom de l'établissement</th>
							<th scope="col">Description</th>
							<th scope="col">Manager</th>
							<th scope="col" class="w-20">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($items as $item)

						<tr>
							<th scope="row">{{ $item->id }}</th>
							<td scope="row">{{ $item->name }}</td>
							<td scope="row">{{ $item->description }}</td>
							<td scope="row">{{ $item->user->name }}</th>
								<td scope="row" class="w-20">
										<button class="btn btn-success btn-sm" 
												data-toggle="modal" 
												data-target="#acceptBarModal" 
												data-url="{{ route('bar-delete',$item->id) }}" 
												data-name="{{ $item->name }}" 
												data-toggle="modal" data-target="#exampleModal">
												<span class="icon icon-checkmark"></button>
								</td>
											</tr>
											@endforeach
										</tbody>
									</table>
									@role('manager')
									{{ $items->count()}}/5 bars
									@endrole
									@role('admin')
									{{ $items->links() }}
									{{ $items->count()}}/{{$items->total()}}
									@endrole
								</div>
							</div>
						</div>
					</div>
					
					<div class="modal fade" id="acceptBarModal" tabindex="-1" role="dialog" aria-labelledby="acceptBarModal" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="acceptBarModal">Valider le bar</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form id="form-delete" method="POST" action="" accept-charset="UTF-8">
										{{ Form::token() }}
										Voulez vous vraiment valider ce bar ? Il sera public et les utilisateurs pourront le suivre.
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
										<button type="submit" class="btn btn-success">Confirmer</button>
									</div>
								</form>  
								
							</div>
						</div>
					</div>

					@endsection
					


