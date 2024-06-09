@extends('dashboard')

@section('crud_content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="font-weight-bold text-primary">
                Nuevo Detalle de venta
            </h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('detalleventas.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="venta_id" class="form-label">Venta</label>
                            <select name="venta_id" id="venta_id" class="form-select" required>
                                <option value="">Seleccione un Venta</option>
                                @foreach ($ventas as $venta)
                                    <option value="{{ $venta->id }}">{{ $venta->fecha_venta }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="producto_id" class="form-label">Producto</label>
                            <select name="producto_id" id="producto_id" class="form-select" required>
                                <option value="">Seleccione un Producto</option>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id }}">{{ $producto->tipo->descripcion }} {{ $producto->modelo->descripcion }} {{ $producto->marca->marca }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" name="cantidad" id="cantidad" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="precio_unitario" class="form-label">Precio de Unitario</label>
                            <input type="number" name="precio_unitario" id="precio_unitario" step="0.01" class="form-control" required>
                        </div>

                       
                        <div class="mb-3">
                            <label for="tipopago_id" class="form-label">Detalles de venta</label>
                            <select name="tipopago_id" id="tipopago_id" class="form-select" required>
                                <option value="">Seleccione un Producto</option>
                                @foreach ($tipopagos as $tipopago)
                                    <option value="{{ $tipopago->id }}">{{ $tipopago->tipo }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-dark me-3">Guardar</button>
                            <a href="{{ route('detalleventas.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
