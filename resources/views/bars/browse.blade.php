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
					<a class="btn btn-success" href="{{ route('manage-bars-create')}}"> Ajouter un bar </a>
				</div>
				<br>
				<table class="table table-hover">
					<thead class="thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nom de l'établissement</th>
							<th scope="col">Description</th>
							@role('admin')
							<th scope="col">Auteur</th>
							@endrole
							<th scope="col">Status</th>
							<th scope="col" class="w-20">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($items as $item)

						<tr>
							<th scope="row">{{ $item->id }}</th>
							<td scope="row">{{ $item->name }}</td>
							<td scope="row">{{ $item->description }}</td>
							@role('admin')
							<td scope="row">{{ $item->user->name }}</th>
							@endrole
							@if( $item->status == false )
							<td scope="row"><span class="badge badge-warning">En attente de validation</span></td>
							@endif
							@if( $item->status == true )
							<td scope="row"><span class="badge badge-success">En ligne</span></td>
							@endif
							<td scope="row">
								<a href="{{ route($editGalleryAction,$item->id)}}" class="btn btn-secondary btn-sm"><span class="icon icon-image"></a>
								<a href="{{ route('bar-single',$item->slug) }}/" target="_blank" class="btn btn-info btn-sm"><span class="icon icon-binoculars"></a>
									<a href="{{ route($editAction,$item->id)}}" class="btn btn-success btn-sm"><span class="icon icon-wrench"></a>
										<a href="" class="btn btn-danger btn-sm"><span class="icon icon-bin"></a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							@role('manager')
							{{ $items->count()}}/5 bars
							@endrole
						</div>
					</div>
				</div>
			</div>
			@endsection