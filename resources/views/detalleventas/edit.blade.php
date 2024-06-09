@extends('dashboard')
@section('crud_content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-center font-weight-bold text-primary">
                Editar Producto
            </h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                <form method="POST" action="{{ route('detalleventas.update', $detalleventa->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="venta_id" class="form-label">Venta</label>
                            <select name="venta_id" id="venta_id" class="form-control @error('venta_id') is-invalid @enderror" required>
                                <option value="">Seleccione una venta</option>
                                @foreach ($ventas as $venta)
                                    <option value="{{ $venta->id }}" {{ $detalleventa->id == old('venta_id', $venta->fecha_venta) ? 'selected' : '' }}>
                                        {{ $venta->fecha_venta }}
                                    </option>
                                @endforeach
                            </select>
                            @error('venta_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="producto_id" class="form-label">Producto</label>
                            <select name="producto_id" id="producto_id" class="form-select" required>
                                <option value="">Seleccione un Producto</option>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id }}" {{ $detalleventa->producto_id == $producto->id ? 'selected' : '' }}>
                                        {{ $producto->tipo->descripcion }} {{ $producto->modelo->descripcion }} {{ $producto->marca->marca }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        

                        <div class="mb-3">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" name="cantidad" id="cantidad" value="{{ old('cantidad', $detalleventa->cantidad) }}" step="0.01" class="form-control @error('cantidad') is-invalid @enderror" required>
                            @error('cantidad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="precio_unitario" class="form-label">Precio Unitario</label>
                            <input type="number" name="precio_unitario" id="precio_unitario" value="{{ old('precio_unitario', $detalleventa->precio_unitario) }}" step="0.01" class="form-control @error('precio_unitario') is-invalid @enderror" required>
                            @error('precio_unitario')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tipopago_id" class="form-label">Tipo pago</label>
                            <select name="tipopago_id" id="tipopago_id" class="form-control @error('tipopago_id') is-invalid @enderror" required>
                                <option value="">Seleccione una tipo pago</option>
                                @foreach ($tipopagos as $tipopago)
                                    <option value="{{ $tipopago->id }}" {{ $detalleventa->id == old('tipopago_id', $tipopago->id) ? 'selected' : '' }}>
                                        {{ $tipopago->tipo}}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipopago_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
