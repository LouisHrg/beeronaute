@extends ('layouts.layout-admin')

@include('layouts.navbar-manage')

@section('title','Manage')

@section('breadcrumb')
<div class="container feed">
	<div class="row">
		<div class="col-md-12">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="">Dashboard</a></li>
					<li class="breadcrumb-item active">Paramètres</li>
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

        {!! Form::open(['action' => 'ManageController@saveSettings', 'method' => 'post','files'=>true ]) !!}
        {{ Form::token() }}
        
        <div class="form-group">
          {{ Form::label('Recevoir un email quand un participant rejoint un évenement', null, ['class' => 'control-label']) }}
          {{ Form::select('price', ['1' => 'Oui', '2' => 'Non'],1,['class'=>'custom-select']) }}
        </div>

        <div class="form-group">
          {{ Form::label("Envoyer un email aux participants quand l'évenement commence bientôt", null, ['class' => 'control-label']) }}
          {{ Form::select('price', ['1' => 'Oui', '2' => 'Non'],1,['class'=>'custom-select']) }}
        </div>


        {{ Form::bsSubmit('Sauvegarder') }}


        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection