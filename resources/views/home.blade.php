<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">

    <!-- se muestran las direcciones de las tablas-->
    <ul class="navbar-nav mr-auto flex-row">
        <li class="nav-item mx-2">
            <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
        </li>
        <li class="nav-item mx-2">
            <a class="nav-link" href="{{ route('marcas.index') }}">{{ __('Marcas') }}</a>
        </li>
        <li class="nav-item mx-2">
            <a class="nav-link" href="{{ route('cargos.index') }}">{{ __('Cargo') }}</a>
        </li>
        <!-- Agrega más elementos de navegación aquí -->
        <li class="nav-item mx-2">
            <a class="nav-link" href="{{ route('generos.index') }}">{{ __('Generos') }}</a>
        </li>
        <li class="nav-item mx-2">
            <a class="nav-link" href="{{ route('tipos.index') }}">{{ __('Tipos') }}</a>
        </li>
        <li class="nav-item mx-2">
            <a class="nav-link" href="{{ route('tallas.index') }}">{{ __('Tallas') }}</a>
        </li>
        <li class="nav-item mx-2">
            <a class="nav-link" href="{{ route('modelos.index') }}">{{ __('Modelos') }}</a>
        </li>
        <li class="nav-item mx-2">
            <a class="nav-link" href="{{ route('colors.index') }}">{{ __('Colores') }}</a>
        </li>
        <li class="nav-item mx-2">
            <a class="nav-link" href="{{ route('estilos.index') }}">{{ __('Estilos') }}</a>
        </li>
        <li class="nav-item mx-2">
            <a class="nav-link" href="{{ route('composiciones.index') }}">{{ __('Composiciones') }}</a>
        </li>


    </ul>


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <br>
                <div class="row justify-content-center">
                    <p>Hola como estas ?
                        Ya listo para registrar mas merca?
                    </p>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
