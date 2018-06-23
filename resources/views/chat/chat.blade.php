@extends('layouts.app')

@section('breadcrumb')
<div class="container feed">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('bars') }}">Evenements</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('event-single',$event->id) }}">{{ucfirst($event->name) }}</a></li>
                    <li class="breadcrumb-item active">Chat</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
@include('layouts.navbar')

<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-body" style="overflow: auto; height: 60vh;">
                    <chat-messages :messages="messages" :user="{{ Auth::user() }}">

                    </chat-messages>
                </div>
                <div class="panel-footer">
                    <chat-form v-on:messagesent="addMessage" :user="{{ Auth::user() }}" :eventid="'{!! $eventId !!}'">

                    </chat-form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection