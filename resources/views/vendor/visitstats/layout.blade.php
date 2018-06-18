@extends($visitortrackerLayout)

@section('breadcrumb')
<div class="container feed">
	<div class="row">
		<div class="col-md-12">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('admin-home') }}">Dashboard</a></li>
					<li class="breadcrumb-item active">Statistiques</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
@endsection

@section($visitortrackerSectionContent)*
@include('layouts.navbar-admin')
<div class="container">
<div class="col-md-12">
    <link rel="stylesheet"
        property="stylesheet"
        href="/vendor/visitortracker/css/visitortracker.css">

    <h1>Statistiques</h1>

    @yield('visitortracker_content')
</div>
</div>
@endsection