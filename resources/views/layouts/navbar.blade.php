<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="{{ asset('img/brand/beer.png') }}" width="30" height="30" class="d-inline-block align-top" alt="">
    

  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor03">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">Fil d'actualité<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('bars') }}">Rechercher un bar</a>
      </li>      
      <li class="nav-item">
        <a class="nav-link" href="">Recommandations</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Evenements
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('events') }}">Tous les évenements</a>
          <a class="dropdown-item" href="{{ route('events-me') }}">Mes évenements</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('news') }} ">News </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="icon icon-bell"> </span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          @foreach(\Request::get('notifs') as $notif)

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
          @endforeach
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('notifs') }}">Tout voir</a>
          <a class="dropdown-item" href="#">Tout marquer comme lu</a>
        </div>
      </li>

    </ul>

    <ul class="navbar-nav ml-auto">
      @role('admin')
      <li class="nav-item" style="margin-top: 3px;">
        <a class="nav-link" href="{{ route('admin-home') }}">Espace Admin</a>
      </li>
      @endrole
      @role('manager')
      <li class="nav-item" style="margin-top: 3px;">
        <a class="nav-link" href="{{ route('manage-home') }}">Espace Manager</a>
      </li>
      @endrole
      @role('moderator')
      <li class="nav-item" style="margin-top: 3px;">
        <a class="nav-link" href="{{ route('moderator-home') }}">Espace Modérateur</a>
      </li>
      @endrole
      @if (Route::has('login'))
      @auth
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{ Auth::user()->name }}
          <img src="{{ Auth::user()->getFirstMedia('avatar-user')->getUrl() }}" class="avatar img-responsive">
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <h6 class="dropdown-header"></h6>
          <a class="dropdown-item" href="{{ route('profile', \Auth::user()->name) }}"><span class="icon icon-user"></span> Mon profil</a>
          <a class="dropdown-item" href="{{ route('logout') }}"><span class="icon icon-cogs"></span> Paramètres</a>
          <a class="dropdown-item" href="{{ route('logout') }}"><span class="icon icon-exit"></span> Se déconnecter</a>
        </div>
      </li>
      @else
      <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">Register</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('login') }}">Se connecter <span class="sr-only">(current)</span></a>
      </li>
      @endauth
      @endif
    </ul>
  </div>
</nav>