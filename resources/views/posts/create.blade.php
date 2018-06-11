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


        {{ Form::bsTextLong('body','Post',"", old('description'),[],"Saisissez une description pour votre bar") }}           

        {{ Form::bsSelect('city', \App\Place::all(),'city','Contenu') }}
          
        {{ Form::bsSubmit('Ajouter') }}


        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

@endsection