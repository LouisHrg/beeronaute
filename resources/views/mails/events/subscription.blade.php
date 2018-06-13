@extends('mails.layouts.mail')

@section('title','Inscription')

@section('greetings','Hey '.ucfirst(\Auth::user()->firstname))

@section('toptext','Vous vous êtes inscrit à l\'evenement')

@section('bottomtext','C trop bien');

