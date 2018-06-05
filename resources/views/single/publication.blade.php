@extends('layouts.layout')

@section('content')
@include('layouts.navbar')
<div class="container block">
{{ $post }}
</div>
@endsection