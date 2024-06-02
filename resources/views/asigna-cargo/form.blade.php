@extends('dashboard')

@section('crud_content')
    <div class="container">
        <h1>Crear Asignacion_cargo</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
        <form method="POST" action="{{ route('asigna-cargos.store') }}">
            @csrf

            <div class="form-group">
                <label for="empleado_id">Origen Id:</label>
                <select class="form-control" id="empleado_id" name="empleado_id">
                    @foreach ($empleados as $id => $nombre)
                        <option value="{{ $id }}">{{ $nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="cargo_id">Origen Id:</label>
                <select class="form-control" id="cargo_id" name="cargo_id">
                    @foreach ($cargos as $id => $descripcion)
                        <option value="{{ $id }}">{{ $descripcion }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Crear Marca</button>
        </form>
    </div>
@endsection


