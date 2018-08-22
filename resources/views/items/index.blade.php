@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registrar ítem</div>

                <div class="card-body">
                    <form action="{{ url('/items') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Nombre del ítem</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Ingresar nombre del ítem y presionar ENTER" required>
                        </div>
                    </form>
                </div>
            </div>            

            <div class="card mt-2">
                <div class="card-header">Ítems</div>

                <div class="card-body">
                    <form action="{{ url('/items') }}" method="get">
                        <div class="form-group">
                            <input type="text" name="search" class="form-control" placeholder="Buscar por nombre" value="{{ $search }}">
                        </div>
                    </form>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Ítem</th>
                                <th>Fecha de registro</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <form action="{{ url('/items/'.$item->id) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <a href="{{ url('/items/'.$item->id) }}" class="btn btn-primary">
                                            Editar
                                        </a>
                                        <button type="submit" class="btn btn-danger">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $items->appends(['search' => $search])->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
