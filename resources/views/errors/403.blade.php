@extends('errors::layout')

@section('title', 'Page Non Trouvée')

@section('message')
Désolé, vous n'avez pas le droit d'accéder à cette page.
<br>
<br>
<img src="{{ asset('img/ui/403.gif') }}">
@endsection
