@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/choices.min.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Cargar valores</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <p>Se encontraron los siguientes errores:</p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ url('/prices') }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="location">Ubicación</label>
                            <select name="location_id" id="location" class="form-control">
                                <option placeholder value="">Seleccione ubicación</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="item">Ítem</label>
                            <select name="item_id" id="item" class="form-control">
                                <option placeholder value="">Seleccione ítem</option>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="value">Valor a cargar</label>
                            <input type="text" class="form-control" id="value" name="value" placeholder="000.00">
                        </div>
                        <div class="form-group">
                            <label for="date">Fecha actual</label>
                            <input type="date" id="date" class="form-control" value="{{ date('Y-m-d') }}" disabled>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Confirmar y cargar valor
                        </button>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    Últimos valores cargados
                </div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Ítem</th>
                                <th>Ubicación</th>
                                <th>Valor</th>
                                <th>Fecha de carga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prices as $price)
                            <tr>
                                <td>{{ $price->item->name }}</td>
                                <td>{{ $price->location->name }}</td>
                                <td>{{ $price->value }}</td>
                                <td>{{ $price->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/choices.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const locationChoices = new Choices('#location');
            const itemChoices = new Choices('#item');
        });        
    </script>
@endsection
