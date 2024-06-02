@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.2.0-beta2/css/bootstrap.min.css">

    @vite(['resources/js/app.js'])
<div class="container">
    <div class="row m-3">
        <div class="col-md-3">
            <!-- Menú de navegación -->
            <ul class="nav flex-column">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('origenes.index') }}">{{ __('Origenes_Marca') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('marcas.index') }}">{{ __('Marca') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('asigna-cargos.index') }}">{{ __('Asignar cargos') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cargos.index') }}">{{ __('Cargo') }}</a>
                </li>
                <!-- Agrega más elementos de navegación aquí -->
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
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('personas.index') }}">{{ __('Personas') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('proveedores.index') }}">{{ __('Proveedores') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('empleados.index') }}">{{ __('Empleados') }}</a>
                </li>
            </ul>
        </div>
        <div class="col-md-9">
            <!-- Sección para mostrar datos CRUD -->
            @yield('crud_content')
        </div>
    </div>
</div>
@endsection
@section('styles')
<link href="{{asset('css/estilo_index.css')}}" rel="stylesheet">
@endsection