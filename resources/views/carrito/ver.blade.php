@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Carrito de Compras</h2>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(count($carrito) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carrito as $id => $detalle)
                    <tr>
                        <td>{{ $detalle['producto']->tipo->descripcion }}</td>
                        <td>
                            <!-- Botones para incrementar y decrementar cantidad -->
                            <form action="{{ route('carrito.actualizar', $id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="action" value="increment">
                                <button type="submit" class="btn btn-sm btn-primary">+</button>
                            </form>
                            {{ $detalle['cantidad'] }}
                            <form action="{{ route('carrito.actualizar', $id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="action" value="decrement">
                                <button type="submit" class="btn btn-sm btn-primary">-</button>
                            </form>
                        </td>
                        <td>{{ $detalle['producto']->precio_compra }}</td>
                        <td>{{ $detalle['producto']->precio_compra * $detalle['cantidad'] }}</td>
                        <td>
                            <form action="{{ route('carrito.eliminar', $id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-end">
            <h4>Total: ${{ array_sum(array_map(function($detalle) {
                return $detalle['producto']->precio_compra * $detalle['cantidad'];
            }, $carrito)) }}</h4>
        </div>
        <div class="text-end">
            <!-- Botón para proceder al pago -->
            @if($haySuficienteStock)
            @else
                <button class="btn btn-success" disabled>No hay suficiente stock</button>
            @endif
        </div>
    @else
        <p>No hay productos en el carrito.</p>
    @endif
</div>
@endsection
