@extends ('layouts.layout-admin')

@include('layouts.navbar-manage')

@section('title','Manage')

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
			@if(!$bars->isEmpty())
			<div class="block ">
				@foreach($bars as $bar)
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-2">
								<div class="img-prog-thumb">
								{{ $bar->getFirstMedia('featured-bar') }}
								</div>
							</div>
							<div class="col-md-10">
								<h4> {{ $bar->name }} </h4>
								<p> {{ $bar->description }} </p>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
			@else
			<div class="alert alert-warning">
				<h4 class="alert-heading">Aucun bar !</h4>
				<p class="mb-0">Veuillez ajouter au moins 1 bar ! <a href="{{ route('manage-bars-create') }}" class="alert-link">Ajouter mon bar</a>.</p>
			</div>
			@endif
		</div>
	</div>
</div>
@endsection