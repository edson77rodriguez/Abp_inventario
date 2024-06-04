@extends('layouts.app')
@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Listado de Productos</h2>
    <div class="mb-3 text-end">
        <a href="{{ route('productos.create') }}" class="btn btn-dark text-white float-right mb-3 p-2">Nuevo Producto</a>
    </div>
    <div class="table-container">
        <table class="table table-bordered table-hover w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Marca</th>
                    <th>Talla</th>
                    <th>Género</th>
                    <th>Modelo</th>
                    <th>Color</th>
                    <th>Composición</th>
                    <th>Estilo</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Proveedor</th>
                    <th>Fecha de Registro</th>
                    <th>Hora</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>{{ $producto->tipo->nombre }}</td>
                        <td>{{ $producto->marca->nombre }}</td>
                        <td>{{ $producto->talla->nombre }}</td>
                        <td>{{ $producto->genero->nombre }}</td>
                        <td>{{ $producto->modelo->nombre }}</td>
                        <td>{{ $producto->color->nombre }}</td>
                        <td>{{ $producto->composicion->nombre }}</td>
                        <td>{{ $producto->estilo->nombre }}</td>
                        <td>{{ $producto->cantidad }}</td>
                        <td>{{ $producto->precio }}</td>
                        <td>{{ $producto->proveedor->nombre }}</td>
                        <td>{{ $producto->fecha_reg }}</td>
                        <td>{{ $producto->hora }}</td>
                        <td>
                            <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-info me-2 p-1">Ver</a>
                            <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-primary me-2 p-1">Editar</a>
                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger p-1" onclick="return confirm('¿Estás seguro de querer eliminar este producto?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
