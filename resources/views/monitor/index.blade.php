@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Monitoreo de precios</div>

                <div class="card-body">
                    <form action="{{ url('/monitor') }}" method="get">
                        <div class="form-group">
                            <label for="search">Buscar ítem</label>
                            <input type="text" name="search" id="search" class="form-control" placeholder="Ingresar nombre de ítem y presionar ENTER" value="{{ $search }}">
                        </div>
                    </form>

                    <p>Valores cargados en la última semana ({{ $startDate }} - {{ $endDate }})</p>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Ítem</th>
                                <th>Menor valor</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->lowestValue($startDate, $endDate) }}</td>
                                <td>
                                    <a href="{{ 
                                        route('monitor', [
                                            'search' => $search, 
                                            'page' => $items->currentPage(),
                                            'item_id' => $item->id
                                        ]) 
                                    }}" class="btn btn-info btn-sm">
                                        Ver detalles
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $items->appends(['search' => $search])->links() }}
                </div>
            </div>

            @if (count($prices) > 0)
            <div class="card mt-4">
                <div class="card-header">Detalles del ítem seleccionado</div>

                <div class="card-body">
                    <a href="{{ url('/items/'.$itemId.'/prices') }}" class="btn btn-success">
                        Descargar como Excel
                    </a>

                    <table class="table table-hover mt-2">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Ubicación</th>
                                <th>Valor cargado</th>
                                <th>Fecha de carga</th>
                                @if (auth()->user()->is_admin)
                                <th>Opciones</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prices as $price)
                            <tr>
                                <td>{{ $price->user->name }}</td>
                                <td>{{ $price->location->name }}</td>
                                <td>{{ $price->value }}</td>
                                <td>{{ $price->created_at }}</td>
                                @if (auth()->user()->is_admin)
                                <td>
                                    <form action="{{ url('/prices/'.$price->id) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <button type="submit" class="btn btn-danger">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection
