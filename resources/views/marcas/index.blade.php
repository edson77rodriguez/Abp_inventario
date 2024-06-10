@extends('dashboard')

@section('crud_content')
<div class="container py-5">
    <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span id="card_title">{{ __('Marcas') }}</span>
            <div class="float-right">
                <button class="btn btn-dark me-3 float-right" data-bs-toggle="modal" data-bs-target="#createMarcaModal">
                    {{ __('Create New') }}
                </button>
            </div>
        </div>
    </div>
    <div class="table-container">
        <table class="table table-bordered table-hover w-100">
            <thead id="tablab">
                <tr>
                    <th>ID</th>
                        <th>Marca</th>
                        <th>Pais</th>
                        <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                 @foreach($marcas as $marca)
                        <tr id='demo'>
                            <td>{{ $marca->id }}</td>
                            <td>{{ $marca->marca }}</td>
                            <td>{{ $marca->origen->pais }}</td>
                            <td>
                            <button class="btn btn-info me-2 p-1" data-bs-toggle="modal" data-bs-target="#viewMarcaModal{{ $marca->id }}">Ver</button>
                            <button class="btn btn-primary me-2 p-1" data-bs-toggle="modal" data-bs-target="#editMarcaModal{{ $marca->id }}">Editar</button>
                            <form action="{{ route('marcas.destroy', $marca->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $marca->id }}')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    <!-- Modal Ver Producto -->
                    <div class="modal fade" id="viewMarcaModal{{ $marca->id }}" tabindex="-1" aria-labelledby="viewProductMarcaLabel{{ $marca->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewMarcaModalLabel{{ $marca->id }}">Ver Marca</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Aquí puedes incluir los detalles del producto -->
                                    <p>ID: {{ $marca->id }}</p>
                                    <p>Marca: {{ $marca->marca }}</p>
                                    <p>Marca: {{ $marca->origen->pais }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Editar Producto -->
                    <div class="modal fade" id="editMarcaModal{{ $marca->id }}" tabindex="-1" aria-labelledby="editMarcaModalLabel{{ $marca->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editMarcaModalLabel{{ $marca->id }}">Editar Marca</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Aquí puedes incluir el formulario de edición del producto -->
                                    <form method="POST" action="{{ route('marcas.update', $marca->id) }}">
                                        @csrf
                                        @method('PUT')

                                       <div class="mb-3">
                                            <label for="marca" class="form-label">Marca</label>
                                            <input type="text" name="marca" id="marca" value="{{ old('marca', $marca->marca) }}" class="form-control @error('marca') is-invalid @enderror" required>
                                            @error('marca')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="origen_id" class="form-label">Origen</label>
                                            <select name="origen_id" id="origen_id" class="form-control @error('origen_id') is-invalid @enderror" required>
                                                <option value="">Seleccione un origen</option>
                                                @foreach ($origenes as $origen)
                                                    <option value="{{ $origen->id }}" {{ $origen->id == old('origen_id', $marca->origen_id) ? 'selected' : '' }}>
                                                        {{ $origen->pais }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('origen_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div> 
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-3">Guardar Cambios</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Crear Producto -->
    <div class="modal fade" id="createMarcaModal" tabindex="-1" aria-labelledby="createMarcaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createMarcaModalLabel">Crear Nueva Marca</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('marcas.store') }}">
                        @csrf

                       <div class="mb-3">
                            <label for="marca" class="form-label">Marca </label>
                            <input type="text" name="marca" id="marca" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="origen_id" class="form-label">Orige:</label>
                            <select name="origen_id" id="origen_id" class="form-select" required>
                                <option value="">Seleccione un origen</option>
                                @foreach ($origenes as $origen)
                                    <option value="{{ $origen->id }}">{{ $origen->pais }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-3">Guardar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KF6o/kJF/b7ICQ1Zfs0cQ45oM0v4lL+SzR0t4i0p54K/xY8q3jOAV5tQ9l" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/alertifyjs/build/alertify.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/alertify.min.css"/>


<script>
     alertify.set('notifier', 'position', 'top-center');
    alertify.set('notifier', 'classes', {
        'success': 'bg-success text-white',
        'error': 'bg-danger text-white',
        'warning': 'bg-warning text-dark'
    });
    alertify.set('notifier', 'delay', 3);
    function confirmDelete(id) {
        alertify.confirm('Eliminar', '¿Estás seguro de que deseas eliminar este d_venta?', function(){
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = '/marcas/' + id;
            form.innerHTML = '@csrf @method("DELETE")';
            document.body.appendChild(form);
            form.submit();
        }, function(){
            alertify.error('Cancelado');
        });
    }
</script>
@if(session('register'))
        <script>
            alertify.success('Registro exitoso');
        </script>
@endif
@if(session('destroy'))
        <script>
            alertify.success('Eliminado');
        </script>
@endif
@endsection
