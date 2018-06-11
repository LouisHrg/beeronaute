@extends('layouts.layout')

@section('content')
@include('layouts.navbar')
<div class="container feed">
	<div class="row ">
		<div class="mx-auto col-md-10">
			<div class="card text-white bg-dark">
				<div class="img-bar-home">
					{{ $bar->getFirstMedia('featured-bar') }}
				</div>
				<div class="block-body">
					<div class="row text-center">
						<div class="mx-auto col-md-4">
							<h1 class="text-center">{{ $bar->name }}</h1>
							<p class="text-center sub">{!! $bar->description !!}</p>
						</div>
					</div>
					<div class="row text-center">
						<div class="col-md-4">
							<p> {{ $bar->location }}</p>
							<p><span class="icon icon-pushpin"></span> {{ $bar->city->name }}</p>
						</div>
						<div class="col-md-4">
							{!! $bar->printSchedule() !!}
							<br>
							@if($bar->instantScheduleInfo() == 1)
							<strong>Actuellement ouvert</strong>
							@else
							<strong>Actuellement fermé</strong>
							@endif

						</div>
						<div class="col-md-4">
							<p><span class="icon icon-phone"></span> {{ $bar->phone }}</p>
							@isset($bar->email)
							<p><span class="icon icon-mail"></span> {{ $bar->email }}</p>
							@endisset
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					@foreach($posts as $post)

					<div class="card feed-element block-feed block-home">
						<div class="card-body">
							<h4 class="card-title">{{ $post->title }}</h4>
							<h6 class="card-subtitle mb-2 text-muted">{{ $post->published->diffForHumans() }}</h6>
							<p class="card-text">{!! $post->content !!}</p>
							<a href="{{ route('publication-single',$post->slug)  }}" class="card-link">Lire la suite...</a>
						</div>
					</div>

					@endforeach

				</div>
			</div>
		</div>

	</div>
</div>
@endsection