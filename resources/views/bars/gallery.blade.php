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
					<li class="breadcrumb-item active"><a href="{{ route('manage-bars') }}">Bars</a></li>
					<li class="breadcrumb-item active">Gallerie de "{{ $bar->name }}"</li>
					@endrole
					@role('admin')
					<li class="breadcrumb-item"><a href="{{ route('admin-home') }}">Dashboard</a></li>
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
					<h4> Image mise en avant </h4>
					<div class="img-bar-home-event">{{ $bar->getFirstMedia('featured-bar') }}</div>
					
					{!! Form::open(['action' => ['BarsController@saveFeatured',$bar->id], 'method' => 'POST','files'=>true ]) !!}
					
					{{ Form::token() }}
					
					{{ Form::bsFile('featured','Image mise en avant','Upload')}}
					{{ Form::bsSubmit("Modifier l'image mise en avant")}}
					{!! Form::close() !!}

					<br>
					<br>
					<br>
					<h5> Galerie :</h5> 
					<button data-toggle="modal" data-target="#newImgModal" class="btn btn-sm btn-info"> Ajouter une image à la galerie </button>
					<div class="row">
						@foreach($bar->getMedia('gallery-bar') as $img)
						<div class="col-md-4">
							<div class="gallery-img">
								{{ $img }}
								<a href="{{ route('deleteFromGallery',[$bar->id,$img->id]) }}" class="btn btn-sm btn-danger btn-block">Supprimer</a>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="newImgModal" tabindex="-1" role="dialog" aria-labelledby="newImgModal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="newImgModal">Ajouter une image à la galerie</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				{!! Form::open(['action' => ['BarsController@addToGallery',$bar->id], 'method' => 'POST','files'=>true ]) !!}
				{{ Form::token() }}
				
				{{ Form::bsFile('image','Image mise en avant','Upload')}}

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				<button type="submit" class="btn btn-primary">Valider !</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

@endsection