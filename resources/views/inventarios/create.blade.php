@extends('dashboard')

@section('crud_content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="font-weight-bold text-primary">
                Nuevo Inventario
            </h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('inventarios.store') }}">
                        @csrf

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
                            <label for="cantidad_stock" class="form-label">Cantidad en Stock</label>
                            <input type="number" name="cantidad_stock" id="cantidad_stock" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
                            <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" required>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-dark me-3">Guardar</button>
                            <a href="{{ route('inventarios.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
