@extends('layouts.admin')
@section('title', 'Utenti')
@section('content')

  <div class="row">
    <div class="col-md-8">
      <h2>Utenti</h2>
      <hr>
      <table class="table table-hover">
        <thead>
          <th>Id</th>
          <th>Ruolo</th>
          <th>Nome</th>
          <th>Email</th>
          <th></th>
        </thead>
        <tbody>
          @foreach ($users as $key => $user)
            <tr>
              <td>{{ $user->id }}</td>
              <td>{{ $user->user_role->name }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>
                  <div class="btn-group">
                    <button type="button" name="button" class="btn btn-info" data-toggle="modal" data-target="#edit-user-{{ $user->id }}">Modifica</button>
                    <button type="button" name="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-user-{{ $user->id }}">Elimina</button>
                  </div>

                  {{-- Modifica --}}
                  <form class="" action="{{ route('admin.users.edit', $user->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    @component('components.modal', [
                      'title' => 'Modifica Utente',
                      'target' => 'edit-user-'.$user->id
                    ])

                      @slot('content')
                        <div class="form-group">
                          <label for="name">Nome</label>
                          <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" name="email" value="{{ $user->email }}" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="password">Password</label>
                          <input type="password" name="password" value="{{ $user->password }}" class="form-control">
                        </div>
                        <div class="form-group">
                          <select class="form-control" name="role_id">
                            @foreach ($roles as $key => $role)
                              <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      @endslot

                      @slot('buttons')
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                        <button type="submit" class="btn btn-primary">Salva</button>
                      @endslot

                    @endcomponent
                  </form>

                  {{-- Elimina --}}
                  <form class="" action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    @component('components.modal', [
                      'title' => 'Elimina Utente',
                      'target' => 'delete-user-'.$user->id
                    ])

                      @slot('content')
                        <p>
                          Sei sicuro di voler eliminare l'utente {{ $user->name }}?<br>
                          Questa operazione non può essere annullata!
                        </p>
                      @endslot

                      @slot('buttons')
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                        <button type="submit" class="btn btn-danger">Elimina</button>
                      @endslot

                    @endcomponent

                  </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="col-md-4">
      <h2>Nuovo Utente</h2>
      <hr>
      <form class="" action="{{ route('admin.users.create') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('POST') }}
        <div class="form-group">
          <label for="name">Nome</label>
          <input type="text" name="name" value="{{ old('name') }}" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" value="{{ old('email') }}" class="form-control">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group">
          <select class="form-control" name="role_id">
            @foreach ($roles as $key => $role)
              <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
          </select>
        </div>
        <button type="submit" name="button" class="btn btn-primary">Salva</button>
      </form>
    </div>
  </div>

@endsection
