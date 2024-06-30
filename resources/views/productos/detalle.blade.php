
@extends('layouts.app')
<!--     Fonts and icons     -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.2.0-beta2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  
  <link href="{{ asset('/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <link href="{{ asset('/css/alertify.min.css') }}" rel="stylesheet" />
  
  <!-- CSS Files -->
  <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/css/soft-ui-dashboard.css?v=1.0.7') }}">
  <link id="pagestyle" href="{{ asset('/asset/css/soft-ui-dashboard.css?v=1.0.7')}}" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
@section('content')
<div class="container mt-5">
    <h2>{{ $producto->tipo->descripcion }}</h2>
    <div class="row">
        <div class="col-lg-6">
            <img src="{{ asset('storage/' . $producto->imagen) }}" class="img-fluid" alt="{{ $producto->descripcion }}">
        </div>
        <div class="col-lg-6">
        <h2>{{ $producto->descripcion }}</h2>
            <p><strong>Marca:</strong> {{ $producto->marca->marca }}</p>
            <p><strong>Talla:</strong> {{ $producto->talla->descripcion }}</p>
            <p><strong>Género:</strong> {{ $producto->genero->descripcion }}</p>
            <p><strong>Modelo:</strong> {{ $producto->modelo->descripcion }}</p>
            <p><strong>Color:</strong> {{ $producto->color->descripcion }}</p>
            <p><strong>Composición:</strong> {{ $producto->composicion->composicion }}</p>
            <p><strong>Estilo:</strong> {{ $producto->estilo->estilo }}</p>
            <p><strong>Precio:</strong> {{ $producto->precio_compra }}</p>
            <p><strong>Proveedor:</strong> {{ $producto->proveedor->persona->nombre }}</p>
            <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
                @csrf
            <div >
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
                    <g transform="translate(1716.000000, 291.000000)">
                      <g transform="translate(0.000000, 148.000000)">
                        <path class="color-background opacity-6" d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"></path>
                        <path class="color-background" d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z"></path>
                      </g>
                    </g>
                  </g>
                </g>
              </svg>
            </div>
           <button type="submit" class="btn btn-link text-dark p-0 fixed-plugin-close-button">Añadir al Carrito</button>
          </a>
               </form>
        </div>
        
    </div>
</div>
@endsection