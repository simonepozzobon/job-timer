@extends('layouts.admin')
@section('title', "Utente $user->name")
@section('content')

  <div id="app" class="row">
    <div class="col-md-8">
      <todo
        project="{{ json_encode($main_project) }}"
        statuses="{{ json_encode($statuses) }}"
        priorities="{{ json_encode($priorities) }}"
      ></todo>
    </div>
    <div class="col-md-4">
      <projects
        projects="{{ json_encode($projects) }}"
      >
      </projects>
    </div>
  </div>

@endsection
@section('scripts')
  <script src="{{ mix('js/admin-todo.js') }}"></script>
@endsection
