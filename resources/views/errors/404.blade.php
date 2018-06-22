@extends('errors::layout')

@section('title', 'Page Non Trouvée')

@section('message')
Désolé, impossible de trouver la page.
<br>
<br>
<img src="{{ asset('img/ui/404.gif') }}">
@endsection
