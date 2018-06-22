@extends('mails.layouts.mail')

@section('title','Un utilisateur s\' est désinscrit)

@section('greetings','Hey '.ucfirst($event->place->manager->firstname))

@section('toptext')
    <p>Un utilisateur s'est désinscrit : {{$event->name}}</p>
@endsection

@section('bottomtext')
    <p>L'utilisateur : {{ ucfirst($user->firstname) }} a quitté l'event</p>
    <p>L'event : {{ $event->name }}</p>
    <p>Date : {{date('d/m/Y H:i',strtotime($event->startDate))}}</p>
@endsection

@section('actionlink',url('/').'/event/'.$event->id)

@section('actiontext',"Lien vers l'evenement")
