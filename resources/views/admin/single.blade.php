@extends('layouts.admin')
@section('title', "Utente $user->name")
@section('content')

  <div id="app">
    <panel
      main_project="{{ json_encode($main_project) }}"
      projects="{{ json_encode($projects) }}"
      statuses="{{ json_encode($statuses) }}"
      priorities="{{ json_encode($priorities) }}"
    ></panel>
  </div>

@endsection
@section('scripts')
  <script src="{{ mix('js/admin-todo.js') }}"></script>
@endsection
