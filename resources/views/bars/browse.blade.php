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
          <li class="breadcrumb-item active">Dashboard</li>
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
				<table class="table table-hover">
					<thead class="thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nom de l'établissement</th>
							<th scope="col">Description</th>
							<th scope="col">Auteur</th>
							<th scope="col" class="w-15">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($items as $item)

						<tr>
							<th scope="row">{{ $item->id }}</th>
							<td scope="row">{{ $item->name }}</td>
							<td scope="row">{{ $item->description }}</td>
							<td scope="row">{{ $item->user->name }}</td>
							<td scope="row">
								<a href="{{ route('publication-single',$item->slug) }}/" target="_blank" class="btn btn-info btn-sm"><span class="icon icon-binoculars"></a>
								<a href="{{ route($editAction,$item->id)}}" class="btn btn-success btn-sm"><span class="icon icon-wrench"></a>
								<a href="" class="btn btn-danger btn-sm"><span class="icon icon-bin"></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			</div>
			</div>
			</div>
@endsection