@extends('errors::layout')

@section('title', 'Problème serveur')

@section('message')
Désolé mais je crois que le site est cassé.
<br>
<br>
<img src="{{ asset('img/ui/500.gif') }}">
@endsection
