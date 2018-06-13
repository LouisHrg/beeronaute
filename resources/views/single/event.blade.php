@extends('layouts.layout')

@section('content')
@include('layouts.navbar')
<div class="container feed">
	<div class="row">
		<div class="col-md-12">
			<a href="{{ route('bar-single',$event->place->slug) }}" > Retour au bar</a>
			<div class="img-event-single">{{ $event->getFirstMedia('featured-event') }}</div>
			<h1> {{ $event->name }} </h1>
			<p>{!! $event->description !!}</p>
			{{ $event->place->city->name }}
			{{ $event->place->name }}
			{{ $event->place->location }}
		</div>
	</div>
</div>
@endsection