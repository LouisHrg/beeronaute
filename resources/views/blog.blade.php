@extends('layouts.layout-home')


@section('content')

@include('layouts.navbar-blog')
<div class="container feed">
	<div class="row">
		<div class="col-md-12 mx-auto">
			<div class="row no-gutters">
				@foreach($news as $article)
				<div class="col-md-3">
					<div class="container-news">
						<div class="image-div">
							{{ $article->getFirstMedia('featured-publication') }}
						</div>
						<a href="{{ route('single-guest',$article->slug) }}">
							<div class="overlay overlay-home">
								<div class="text">
									<p>{{ ucfirst($article->title) }}</p>
									<p>{{ $article->published->diffForHumans() }}</p>
								</div>
							</div>
						</a>
					</div>
				</div>
				@endforeach
			</div>
			<br>
			{{ $news->links() }}		
		</div>
	</div>	

</div>

@endsection
