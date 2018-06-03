@extends ('layouts.layout-admin')

@section('content')
@include('layouts.navbar-admin')
<div class="container feed">
	<div class="row">
		<div class="col-md-12">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="#">Publications</a></li>
					<li class="breadcrumb-item active" aria-current="page">Nouvelle publication</li>
				</ol>
			</nav>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="block">
				@foreach($items as $item)

				{{ $item }}

				<br>
				
				@endforeach

			</div>
		</div>
	</div>
</div>

@endsection
