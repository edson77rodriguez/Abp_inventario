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
                            <form action="{{ route('carrito.actualizar', $id) }}" method="POST">
                                @csrf
                                <input type="number" name="cantidad" value="{{ $detalle['cantidad'] }}" min="1" class="form-control" style="width: 80px;">
                                <button type="submit" class="btn btn-sm btn-primary mt-2">Actualizar</button>
                            </form>
                        </td>
                        <td>{{ $detalle['precio_venta'] }}</td>
                        <td>{{ $detalle['precio_venta'] * $detalle['cantidad'] }}</td>
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
                return $detalle['precio_venta'] * $detalle['cantidad'];
            }, $carrito)) }}</h4>
        </div>
        <div class="text-end">
            <form action="{{ route('carrito.procesarPago') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="empleado_id" class="form-label">Empleado</label>
                    <select name="empleado_id" id="empleado_id" class="form-select" required>
                        @foreach($empleados as $empleado)
                            <option value="{{ $empleado->id }}">{{ $empleado->persona->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tipopago_id" class="form-label">Tipo de Pago</label>
                    <select name="tipopago_id" id="tipopago_id" class="form-select" required>
                        @foreach($tipopagos as $tipopago)
                            <option value="{{ $tipopago->id }}">{{ $tipopago->tipo }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Proceder al Pago</button>
            </form>
        </div>
    @else
        <p>No hay productos en el carrito.</p>
    @endif
</div>
@endsection
