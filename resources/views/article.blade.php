@extends('layouts.layout-home')


@section('content')

@include('layouts.navbar-blog')
				<img class="banner" src="{{ $article->getFirstMedia('featured-publication')->getUrl() }}">
<div class="container feed">
	<div class="row">
		<div class="col-md-12 mx-auto">
			<div class="row">
				{{ $article->title }}
			</div>		
		</div>
	</div>	

</div>

@endsection
