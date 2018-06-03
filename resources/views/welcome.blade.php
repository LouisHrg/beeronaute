@extends('layouts.layout')


@section('content')

@include('layouts.navbar-home')
<div class="bg container-fluid">
	<div class="row">
		<div class="bg-text">
			<div class="col-md-6 mx-auto">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div>
		</div>	
	</div>	

</div>
<div class="container" data-spy="scroll" data-target="#navbar-home" data-offset="0" >
	<div id="us" class="bigblock us-block">
		<h1>Nous</h1>
	</div>
	<div id="concept" class="bigblock concept-block">
		<h1>Concept</h1>
	</div>
	<div id="news" class="bigblock news-block">
		<h1>News</h1>
	</div>
</div>
@endsection
