
@extends ('layouts.layout-admin')

@role('manager')
@include('layouts.navbar-manage')
@endrole
@role('admin')
@include('layouts.navbar-admin')
@endrole

@section('title','Admin | Beeronaute')


@section('breadcrumb')
<div class="container feed">
	<div class="row">
		<div class="col-md-12">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('manage-home') }}">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="{{ route('manage-bars') }}">Bar</a></li>
					<li class="breadcrumb-item active" aria-current="page">Ajouter bar</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="block">



				@if ($errors->any())
				<div class="alert alert-dismissible alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif

				{!! Form::open(['action' => $action, 'method' => $method,'files'=>true ]) !!}
				{{ Form::token() }}

				{{ Form::bsText('title','Titre','Le titre', old('title'),[],"Le titre de l'évènement") }}

				{{ Form::trumbo('content','Contenu', old('content'),[],"Le contenu de l'article") }}           

        		{{ Form::bsFile('featured',"Image d'illustration de l'évenement",'Uploader')}}


				{{ Form::bsDate('published', \Carbon\Carbon::now(), "Date de publication" , "La date de publication de l'article")}}
				
				{{ Form::bsNumber('number',old('number'),"Nombre de place","Nombre d'utilisateur pouvant s'inscrire à l'évenement")}}

        		{{ Form::bsSelect('bar', \App\Bar::where('manager',\Auth::id())->get(),'bar',"Lieu de l'évenement") }}


				<div class="row">
					<div class="col-md-6">        		
						{{ Form::bsDate('startat', \Carbon\Carbon::now(), "Commence le" , "La date de début de l'évenement")}}
					</div>
					<div class="col-md-6">        		
						{{ Form::bsDate('endat', \Carbon\Carbon::now(), "Termine le" , "La date de fin de l'évenement")}}
					</div>
				</div>
				
	        {{ Form::bsSubmit('Créer') }}

				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection
