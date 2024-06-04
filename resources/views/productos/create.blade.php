@extends('dashboard')
@section('crud_content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="font-weight-bold text-primary">
                {{ __('Nuevo Producto') }}
            </h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('productos.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="tipo_id" class="form-label">Tipo</label>
                            <select name="tipo_id" id="tipo_id" class="form-select" required>
                                <option value="">Seleccione un tipo</option>
                                @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="marca_id" class="form-label">Marca</label>
                            <select name="marca_id" id="marca_id" class="form-select" required>
                                <option value="">Seleccione una marca</option>
                                @foreach ($marcas as $marca)
                                    <option value="{{ $marca->id }}">{{ $marca->marca }}</option>
                                @endforeach
                            </select>
                        </div>

                        
                        <div class="mb-3">
                            <label for="talla_id" class="form-label">Talla</label>
                            <select name="talla_id" id="talla_id" class="form-select" required>
                                <option value="">Seleccione una talla</option>
                                @foreach ($tallas as $talla)
                                    <option value="{{ $talla->id }}">{{ $talla->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="genero_id" class="form-label">Género</label>
                            <select name="genero_id" id="genero_id" class="form-select" required>
                                <option value="">Seleccione un género</option>
                                @foreach ($generos as $genero)
                                    <option value="{{ $genero->id }}">{{ $genero->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="modelo_id" class="form-label">Modelo</label>
                            <select name="modelo_id" id="modelo_id" class="form-select" required>
                                <option value="">Seleccione un género</option>
                                @foreach ($modelos as $modelo)
                                    <option value="{{ $modelo->id }}">{{ $modelo->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="color_id" class="form-label">Color</label>
                            <select name="color_id" id="color_id" class="form-select" required>
                                <option value="">Seleccione un género</option>
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="composicion_id" class="form-label">Composicion</label>
                            <select name="composicion_id" id="composicion_id" class="form-select" required>
                                <option value="">Seleccione un género</option>
                                @foreach ($composiciones as $composicion)
                                    <option value="{{ $composicion->id }}">{{ $composicion->composicion }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="estilo_id" class="form-label">Estilo</label>
                            <select name="estilo_id" id="estilo_id" class="form-select" required>
                                <option value="">Seleccione un género</option>
                                @foreach ($estilos as $estilo)
                                    <option value="{{ $estilo->id }}">{{ $estilo->estilo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" name="cantidad" id="cantidad" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" name="precio" id="precio" step="0.01" class="form-control" required>
                        </div>

                     
                        <div class="mb-3">
                            <label for="proveedor_id" class="form-label">Estilo</label>
                            <select name="proveedor_id" id="proveedor_id" class="form-select" required>
                                <option value="">Seleccione un proveedor</option>
                                @foreach ($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}">{{ $proveedor->persona_id }}</option>
                                @endforeach
                            </select>
                        </div> 

                        <div class="mb-3">
                            <label for="fecha_reg" class="form-label">Fecha de Registro</label>
                            <input type="date" name="fecha_reg" id="fecha_reg" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="hora" class="form-label">Hora</label>
                            <input type="time" name="hora" id="hora" class="form-control" required>
                        </div>
                        


                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-dark me-3">Guardar</button>
                            <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
