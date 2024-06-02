@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Marca</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('marcas.store') }}">
            @csrf

            <div class="form-group">
                <label for="Marca">Marca:</label>
                <input type="text" class="form-control" id="Marca" name="Marca" value="{{ old('Marca') }}">
            </div>

            <div class="form-group">
                <label for="origen_id">Origen Id:</label>
                <select class="form-control" id="origen_id" name="origen_id">
                    @foreach ($origenes as $id => $pais)
                        <option value="{{ $id }}">{{ $pais }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Crear Marca</button>
        </form>
    </div>
@endsection
