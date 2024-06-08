<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')


@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.2.0-beta2/css/bootstrap.min.css">

<div class="container">
    
    <div class="row m-1">
        <div class="col-md-2 sidebar">
            <!-- Menú de navegación -->
            <ul class="nav flex-column">
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('inventarios.index') }}">{{ __('Inventarios') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('productos.index') }}">{{ __('Productos') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('origenes.index') }}">{{ __('Origenes_Marcas') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('marcas.index') }}">{{ __('Marcas') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('proveedores.index') }}">{{ __('Proveedores') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('empleados.index') }}">{{ __('Empleados') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cargos.index') }}">{{ __('Cargo') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('personas.index') }}">{{ __('Personas') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('generos.index') }}">{{ __('Generos') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tipos.index') }}">{{ __('Tipos') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tallas.index') }}">{{ __('Tallas') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('modelos.index') }}">{{ __('Modelos') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('colors.index') }}">{{ __('Colores') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('estilos.index') }}">{{ __('Estilos') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('composiciones.index') }}">{{ __('Composiciones') }}</a>
                </li>
            </ul>
        </div>

        
        <div class="col-md-10 ">
            <!-- Título con imagen de fondo -->
            
            <!-- Sección para mostrar datos CRUD -->
            @yield('crud_content')
            
        </div>
    </div>
</div>
@endsection

@section('styles')
<!-- Puedes agregar estilos adicionales aquí -->

@endsection
