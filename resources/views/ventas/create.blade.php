@extends('dashboard')

@section('crud_content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="font-weight-bold text-primary">
                Nueva Venta
            </h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('ventas.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="fecha_venta" class="form-label">Fecha de venta</label>
                            <input type="date" name="fecha_venta" id="fecha_venta" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="empleado_id" class="form-label">¿Quien lo vendio?</label>
                            <select name="empleado_id" id="empleado_id" class="form-select" required>
                                <option value="">Seleccione un empleado</option>
                                @foreach ($empleados as $empleado)
                                    <option value="{{ $empleado->id }}">{{ $empleado->persona->nombre }} {{ $empleado->persona->ap }} {{ $empleado->persona->am }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="ganancia" class="form-label">Cantidad en Stock</label>
                            <input type="number" name="ganancia" id="ganancia" class="form-control" required>
                        </div>

                        

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-dark me-3">Guardar</button>
                            <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
