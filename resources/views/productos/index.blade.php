@extends('dashboard')
@section('crud_content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>proveedors</title>
    <!-- Bootstrap 5 (CSS y JS) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Fwhij5wX9YjAJxm85MMzR1h7vfqZ6P6r64tCcdyecf5W450YfN2vQ9F3iZ2yW3j" crossorigin="anonymous">
    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="{{asset('css/estilo_index.css')}}">
</head>
<div class="container py-5">
<div class="card-header"> 
        <div style="display: flex; justify-content: space-between; align-items: center;">
                <span id="card_title">{{ __('Productos') }}</span>
            
                    <div class="float-right">
                        <a href="{{ route('productos.create') }}" class="btn btn-dark me-3 float-right"  data-placement="left">
                        {{ __('Create New') }}</a>
                    </div>
                
        </div>
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
                    <th>Precio C</th>
                    <th>Precio V</th>
                    <th>Proveedor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>{{ $producto->tipo->descripcion }}</td>
                        <td>{{ $producto->marca->marca }}</td>
                        <td>{{ $producto->talla->descripcion }}</td>
                        <td>{{ $producto->genero->descripcion }}</td>
                        <td>{{ $producto->modelo->descripcion }}</td>
                        <td>{{ $producto->color->descripcion }}</td>
                        <td>{{ $producto->composicion->composicion }}</td>
                        <td>{{ $producto->estilo->estilo }}</td>
                        <td>{{ $producto->precio_compra }}</td>
                        <td>{{ $producto->precio_venta }}</td>
                        <td>{{ $producto->proveedor->persona->nombre }}</td>
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