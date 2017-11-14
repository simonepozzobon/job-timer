<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{ route('home') }}">Simone Pozzobon</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavBar" aria-controls="mainNavBar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="mainNavBar">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.todo-status.index') }}">Modifica Stati</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.users.index') }}">Utenti</a>
      </li>
    </ul>
  </div>
</nav>
