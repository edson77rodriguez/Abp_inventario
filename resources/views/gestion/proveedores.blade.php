@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Listado de Proveedores</h2>
    <div class="row">
        @foreach ($proveedores as $proveedor)
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $proveedor->persona->nombre }}</h4>
                        <p class="card-text"><strong>Apellido Paterno:</strong> {{ $proveedor->persona->ap }}</p>
                        <p class="card-text"><strong>Apellido Materno:</strong> {{ $proveedor->persona->am }}</p>
                        <p class="card-text"><strong>Teléfono:</strong> {{ $proveedor->persona->telefono }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
