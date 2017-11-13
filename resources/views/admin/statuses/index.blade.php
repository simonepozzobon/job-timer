@extends('layouts.admin')
@section('title', 'Stati')
@section('content')

  <div class="row">
    <div class="col-md-8">
      <h2>Stati</h2>
      <hr>
      <table class="table table-hover">
        <thead>
          <th>id</th>
          <th>Stato</th>
          <th></th>
        </thead>
        <tbody>
          @foreach ($statuses as $key => $status)
            <tr>
              <td>{{ $status->id }}</td>
              <td>{{ $status->name }}</td>
              <td>
                <div class="btn-group">
                  <button type="button" name="button" class="btn btn-info" data-toggle="modal" data-target="#edit-status-{{ $status->id }}">Modifica</button>
                  <button type="button" name="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-status-{{ $status->id }}">Elimina</button>
                </div>
                {{-- Modifica --}}
                <form class="" action="{{ route('admin.todo-status.edit', $status->id) }}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}

                  @component('components.modal', [
                    'target' => 'edit-status-'.$status->id,
                    'title' => 'Modifica Stato'
                  ])

                    @slot('content')
                      <div class="form-group">
                        <label for="">Titolo:</label>
                        <input type="text" name="title" value="{{ $status->name }}" class="form-control">
                      </div>
                    @endslot

                    @slot('buttons')
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                      <button type="submit" class="btn btn-primary">Salva</button>
                    @endslot

                  @endcomponent

                </form>

                {{-- Elimina --}}
                <form class="" action="{{ route('admin.todo-status.destroy', $status->id) }}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}

                  @component('components.modal', [
                    'target' => 'delete-status-'.$status->id,
                    'title' => 'Elimina Stato'
                  ])

                    @slot('content')
                      <p>
                        Sei sicuro?<br>
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
      <h2>Nuovo</h2>
      <hr>
      <form class="" action="{{ route('admin.todo-status.create') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('POST') }}
        <div class="form-group">
          <label for="">Titolo:</label>
          <input type="text" name="title" value="{{ old('title') }}" class="form-control">
        </div>
        <button type="submit" name="button" class="btn btn-primary">Salva</button>
      </form>
    </div>
  </div>

@endsection
