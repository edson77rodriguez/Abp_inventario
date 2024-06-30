<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nazli Boutique - Inventory Management System</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/home.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
  <script src="{{ asset('/js/modernizr.js') }}"></script>
  <style>
    body {
      padding-top: 70px; /* Ajusta este valor según la altura de tu navbar */
    }
  </style>
</head>
<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">

<header id="header" class="site-header header-scrolled position-fixed text-black bg-light">
  <nav id="header-nav" class="navbar navbar-expand-lg px-3 mb-3">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
        <img src="{{ asset('img/logo.jpg') }}" class="logo" style="height: 50px;">
        <span class="fs-4 fw-bold text-dark">Nazli Boutique</span>
      </a>
      <button class="navbar-toggler d-flex d-lg-none order-3 p-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#bdNavbar" aria-controls="bdNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <svg class="navbar-icon">
          <use xlink:href="#navbar-icon"></use>
        </svg>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="bdNavbar" aria-labelledby="bdNavbarOffcanvasLabel">
        <div class="offcanvas-header px-4 pb-0">
          <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.jpg') }}" class="logo" style="height: 50px;">
            <span class="fs-4 fw-bold text-dark">Nazli Boutique</span>
          </a>
          <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close" data-bs-target="#bdNavbar"></button>
        </div>
        <div class="offcanvas-body">
          <ul id="navbar" class="navbar-nav text-uppercase justify-content-end align-items-center flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link me-4 active" href="{{ url('/home') }}">Inicio</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link me-4 dropdown-toggle link-dark" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Catálogo</a>
              <ul class="dropdown-menu">
                @foreach ($tipos as $tipo)
                  <li><a class="dropdown-item" href="{{ route('catalogo', $tipo->id) }}">{{ $tipo->descripcion }}</a></li>
                @endforeach
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link me-4 dropdown-toggle link-dark" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Gestión</a>
              <ul class="dropdown-menu">
                <li><a href="{{ route('gestion.inventario') }}" class="dropdown-item">Inventario</a></li>
                <li><a href="{{ route('gestion.ventas') }}" class="dropdown-item">Ventas</a></li>
                <li><a href="{{ route('gestion.proveedores') }}" class="dropdown-item">Proveedores</a></li>
                <li><a href="{{ route('gestion.informes') }}" class="dropdown-item">Informes</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link me-4" href="{{ url('/carrito') }}">Carrito</a>
            </li>
            <li class="nav-item">
              <div class="user-items ps-5">
                <ul class="d-flex justify-content-end list-unstyled">
                  <li class="search-item pe-3">
                    <a href="#" class="search-button">
                      <svg class="search">
                        <use xlink:href="#search"></use>
                      </svg>
                    </a>
                  </li>
                  <li class="pe-3">
                    <a href="#">
                      <svg class="user">
                        <use xlink:href="#user"></use>
                      </svg>
                    </a>
                  </li>
                  <li>
                    <a href="{{ url('/carrito') }}">
                      <svg class="cart">
                        <use xlink:href="#cart"></use>
                      </svg>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</header>

<main class="container mt-5">
    <div class="row">
  <h2 class="text-center mb-4">Productos Destacados</h2>
</div>
  <div class="row">
    @foreach ($productos as $producto)
    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
      <div class="card h-100">
        <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img-top" alt="{{ $producto->tipo ? $producto->tipo->descripcion : 'Sin tipo' }}">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title text-center">{{ $producto->tipo ? $producto->tipo->descripcion : 'Sin tipo' }}</h5>
          <p class="card-text"><strong>Marca:</strong> {{ $producto->marca->marca }}</p>
          <a href="{{ route('productos.detalle', $producto->id) }}" class="btn btn-info mt-auto">Ver Detalle</a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</main>

<footer class="bg-light py-4">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-6">
        <div class="text-center">
          <p>© Copyright 2023 Nazli Boutique. Design by <a href="https://templatesjungle.com/">TemplatesJungle</a> Distribution by <a href="https://themewagon.com">ThemeWagon</a></p>
        </div>
      </div>
    </div>
  </div>
</footer>

<script src="{{ asset('/js/jquery-1.11.0.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script type="text/javascript" src="{{ asset('/js/plugins.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/script.js') }}"></script>
</body>
</html>
