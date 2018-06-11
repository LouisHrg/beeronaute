@extends('layouts.layout')

@section('content')
@include('layouts.navbar')
<div class="container feed">
	<div class="row">
		<div class="mx-auto col-md-10 ">
			<div class="img-bar-home">
			{{ $bar->getFirstMedia('featured-bar') }}
			</div>
			<h1 class="text-center"> {{ $bar->name }} </h1>
			<p>{!! $bar->description !!}</p>
			<p><span class="icon icon-pushpin"></span> {!! $bar->location !!}</p>
			<p>{{ $bar->place }}</p>
			<p>{{ dd($bar->printSchedule()) }}</p>
			<p><span class="icon icon-phone"></span> {{ $bar->phone }}</p>
			<p><span class="icon icon-mail"></span> {{ $bar->email }}</p>
			{{-- <img src="{{ $post->getMedia('images')->first()->getUrl() }}"> --}}
		</div>
	</div>
</div>
@endsection