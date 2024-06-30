@extends('dashboard')

@section('crud_content')
<div class="container py-5">
    <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span id="card_title">{{ __('Proveedores') }}</span>
            <div class="float-right">
                <button class="btn btn-dark me-3 float-right" data-bs-toggle="modal" data-bs-target="#createProveedorModal">
                    {{ __('Create New') }}
                </button>
            </div>
        </div>
    </div>


                    <div class="container mt-4">
    <div class="row">
        @foreach ($proveedores as $proveedor)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $proveedor->persona->nombre}}</h5>
                        <p class="card-text"><strong>Id:</strong> {{ $proveedor->id }}</p>
                        <p class="card-text"><strong>Proveedor:</strong> {{ $proveedor->persona->nombre }} {{ $proveedor->persona->ap }} {{ $proveedor->persona->am }}</p>
                        
                        <div class="d-flex justify-content-between">
                        <button class="btn btn-info me-2 p-1" data-bs-toggle="modal" data-bs-target="#viewProveedorModal{{ $proveedor->id }}">Ver</button>
                            <button class="btn btn-primary me-2 p-1" data-bs-toggle="modal" data-bs-target="#editProveedorModal{{ $proveedor->id }}">Editar</button>
                            <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $proveedor->id }}')">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                    <!-- Modal Ver Producto -->
                    <div class="modal fade" id="viewProveedorModal{{ $proveedor->id }}" tabindex="-1" aria-labelledby="viewProveedorMarcaLabel{{ $proveedor->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewProveedorModalLabel{{ $proveedor->id }}">Ver Proveedor</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Aquí puedes incluir los detalles del producto -->
                                    <p>ID: {{ $proveedor->id }}</p>
                                    <p>Marca: {{ $proveedor->persona->nombre }} {{ $proveedor->persona->ap }} {{ $proveedor->persona->am }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Editar Producto -->
                    <div class="modal fade" id="editProveedorModal{{ $proveedor->id }}" tabindex="-1" aria-labelledby="editProveedorModalLabel{{ $proveedor->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editProveedorModalLabel{{ $proveedor->id }}">Editar Proveedor</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Aquí puedes incluir el formulario de edición del producto -->
                                    <form method="POST" action="{{ route('proveedores.update', $proveedor->id) }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            <label for="persona_id" class="form-label">Persona</label>
                                            <select name="persona_id" id="persona_id" class="form-control" required>
                                                <option value="">Seleccione una persona</option>
                                                @foreach ($personas as $persona)
                                                    <option value="{{ $persona->id }}" {{ $proveedor->persona_id == $persona->id ? 'selected' : '' }}>{{ $persona->nombre }}</option>
                                                @endforeach
                                            </select>
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
    <div class="modal fade" id="createProveedorModal" tabindex="-1" aria-labelledby="createProveedorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createProveedorModalLabel">Crear Nuevo Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('proveedores.store') }}">
                        @csrf

                       <div class="mb-3">
                            <label for="descripcion" class="form-label">Proveedor </label>
                            <select name="persona_id" id="persona_id" class="form-control" required>
                                @foreach($personas as $persona)
                                    <option value="{{ $persona->id }}">{{ $persona->nombre }} {{ $persona->ap }} {{ $persona->am }}</option>
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Eliminar',
            text: '¿Estás seguro de que deseas eliminar este proveedor?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.createElement('form');
                form.method = 'POST'; 
                form.action = '/proveedores/' + id;/// aqui se cambia el nombre de la vista, aqui se llama tipo pagos
                form.innerHTML = '@csrf @method("DELETE")';
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
    function RegistroExitoso() {
        Swal.fire({
            icon: 'success',
            title: 'Registro exitoso',
            text: 'Tu registro ha sido exitoso',
            timer: 1300,
            showConfirmButton: false
        });
    }
    function cambio() {
        Swal.fire({
            icon: 'success',
            title: 'cambio generado',
            text: ' ',
            timer: 1400,
            showConfirmButton: false
        });
    }
</script>

@if(session('register'))
    <script>
        RegistroExitoso();
    </script>
@endif
@if(session('modify'))
    <script>
        cambio();
    </script>
@endif
@if(session('destroy'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Eliminado',
            text: 'El elemento ha sido eliminado exitosamente',
            timer: 1200,
            showConfirmButton: false
        });
    </script>
@endif
@endsection
