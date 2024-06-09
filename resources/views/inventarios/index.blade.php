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
                <span id="card_title">{{ __('inventarios') }}</span>
            
                    <div class="float-right">
                        <a href="{{ route('inventarios.create') }}" class="btn btn-dark me-3 float-right"  data-placement="left">
                        {{ __('Create New') }}</a>
                    </div>
                
        </div>
        </div>
    <div class="table-container">
        
    <table class="table table-bordered table-hover">
                            <thead>
                                <tr id='tablab'>
                                    <th>ID</th>
                                    <th>Producto</th>
                                    <th>Cantidad en Stock</th>
                                    <th>Fecha de Ingreso</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventarios as $inventario)
                                <tr id='demo'>
                                    <td>{{ $inventario->id }}</td>
                                    <td>{{ $inventario->producto->tipo->descripcion }} {{ $inventario->producto->marca->marca }} </td>
                                    <td>{{ $inventario->cantidad_stock }}</td>
                                    <td>{{ $inventario->fecha_ingreso }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                        <a href="{{ route('inventarios.show', $inventario->id) }}" class="btn btn-info me-2 p-1">Ver</a>
                                            <a href="{{ route('inventarios.edit', $inventario->id) }}" class="btn btn-sm btn-info me-2">Editar</a>
                                            <form action="{{ route('inventarios.destroy', $inventario->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
            </table>
    </div>
</div>
@endsection

