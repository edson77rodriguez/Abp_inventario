@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>{{ $tipo->descripcion }}</h2>
    <div class="row">
        @foreach ($productos as $producto)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card">
                <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img-top" alt="{{ $producto->tipo->descripcion }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $producto->descripcion }}</h5>
                    <a href="{{ route('producto.detalle', $producto->id) }}" class="btn btn-info">Ver Detalle</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection