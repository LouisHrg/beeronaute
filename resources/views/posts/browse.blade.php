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
					@role('admin')
					<li class="breadcrumb-item"><a href="{{ route('admin-home') }}">Dashboard</a></li>
					<li class="breadcrumb-item active">Tous les posts</li>
					@endrole
					@role('manager')
					<li class="breadcrumb-item"><a href="{{ route('manage-home') }}">Dashboard</a></li>
					<li class="breadcrumb-item active">Tous les posts</li>
					@endrole
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
				@if (null !== app('request')->input('search'))
				<a href="{{ Request::url() }}" class="btn btn-info"><- Voir tous les éléments </a>
				@else
					<a class="btn btn-success" href="{{ route('manage-post-create')}}"> Ajouter un nouveau post </a>
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
							<th scope="col">Extrait</th>
							<th scope="col">Type</th>
							<th scope="col">Element</th>
							@role('admin')
							<th scope="col">Auteur</th>
							@endrole
							<th scope="col" class="w-15">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($items as $item)
						<tr>
							<th scope="row">{{ $item->id }}</th>
							<td scope="row">{{ $item->body }}</td>
							<td scope="row">{{ $item->type }}</td>
							@role('admin')
							<td scope="row">{{ $item->user->name }}</td>
							@endrole
							<td scope="row">
								<a href="{{ route($editAction,$item->id)}}" class="btn btn-success btn-sm"><span class="icon icon-wrench"></a>
								<a href="" class="btn btn-danger btn-sm"><span class="icon icon-bin"></a>
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

@endsection
