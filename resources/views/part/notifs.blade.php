@forelse(\Request::get('notifs') as $notif)
@if($notif->type == 1 && strtotime($notif->party->startDate) > strtotime(time()))
<a class="dropdown-item {{ !$notif->viewed?'unviewed':'' }}" href="{{ route('event-single',$notif->party->id) }}">
  {{ ucfirst($notif->party->name) }} à {{ date('H:i',strtotime($notif->party->startDate)) }}
</a>
@endif
@if($notif->type == 2 && strtotime($notif->party->startDate) > strtotime(time()))
<a class="dropdown-item {{ !$notif->viewed?'unviewed':'' }}" href="{{ route('event-single',$notif->party->id) }}">
  {{ ucfirst($notif->party->name) }} à commencé
</a>
@endif
@empty
<p class="dropdown-item">Rien pour le moment</p>
@endforelse
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="{{ route('notifs') }}">Tout voir</a>
<a class="dropdown-item" href="{{ route('notifs-readed') }}">Tout marquer comme lu</a>