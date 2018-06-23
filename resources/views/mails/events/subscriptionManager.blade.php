@extends('mails.layouts.mail')

@section('title','Nouvelle souscritption')

@section('greetings','Hey '.ucfirst($event->place->user->firstname))

@section('toptext')
    <p>Un nouvel utilisateur s'est inscrit à l'événement : {{$event->name}}</p>
@endsection

@section('bottomtext')
    <p>L'utilisateur : {{ ucfirst($user->firstname) }}</p>
    <p>L'event : {{ $event->name }}</p>
    <p>Date : {{date('d/m/Y H:i',strtotime($event->startDate))}}</p>
@endsection

@section('actionlink',url('/').'/event/'.$event->id)

@section('actiontext',"Lien vers l'evenement")
