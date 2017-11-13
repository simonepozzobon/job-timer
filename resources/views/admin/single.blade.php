@extends('layouts.admin')
@section('title', "Utente $user->name")
@section('content')

  <div id="app" class="row">
    <div class="col">
      <todo
        todos="{{ json_encode($todos) }}"
        statuses="{{ json_encode($statuses) }}"
      ></todo>
    </div>
  </div>

@endsection
@section('scripts')
  <script src="{{ mix('js/admin-todo.js') }}"></script>
@endsection
