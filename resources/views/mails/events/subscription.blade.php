@extends('mails.layouts.mail')

@section('title','Inscription')

@section('greetings','Hey '.ucfirst(\Auth::user()->firstname))

@section('toptext')
<p>Vous vous êtes inscrit à l'évenemnt : {{$event->name}}</p>
@endsection

@section('bottomtext')
<p>Lieu : {{ $event->place->name }} </p>
<p>Adresse : {{$event->place->location}} à {{$event->place->city->name}}</p>
<p> Date : {{date('d/m/Y H:i',strtotime($event->startDate))}}</p>
@endsection

@section('actionlink',url('/').'/event/'.$event->id)

@section('actiontext',"Lien vers l'evenement")
