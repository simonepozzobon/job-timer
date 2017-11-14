@extends('layouts.admin')
@section('title', 'User Panel')
@section('content')

  <div class="row">
    <div class="col-md-6">
      <h2>Clienti</h2>
      @foreach ($users as $key => $user)
        <div class="row">
          <div class="col-md-8">
            {{ $user->name }}
          </div>
          <div class="col-md-2">
            {{ $user->todo_counts() }}
          </div>
          <div class="col-md-2">
            <a href="{{ route('user.single', $user->id) }}" class="btn btn-primary">Apri</a>
          </div>
        </div>
      @endforeach
    </div>
    <div class="col-md-6">
      <h2>Tasks</h2>
      <div class="row">
        <div class="col-md-8">
          testo da fare
        </div>
        <div class="col-md-2">
          urgenza
        </div>
        <div class="col-md-2">
          data
        </div>
      </div>
    </div>
  </div>

@endsection
