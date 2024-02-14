<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
            <!-- Liens CSS de Bootstrap -->
            <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
          </head>
          <body>
      <div class="container-fluid">
          <div class="row">
            <div class="col-md-2 bg-dark sidebar custom-sidebar">
              <div class="logo mt-2 d-flex justify-content-start align-items-center">
                <img src="../images/image2.png" width="80px" height="40px"  alt="Logo de votre application">
                <span>G.STOCK</span>
              </div>
            <hr style="color: white">
              <ul class="navbar-nav flex-column">
                  <li class="nav-item">
                      <a class="nav-link text-white <?php echo (request()->is('/')) ? 'active rounded' : ''; ?>" href="{{ route('dashboard')}}">
                        <i class="fa fa-home p-2"></i><span class="hide-text">Accueil</span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link text-white<?php echo (request()->is('produits')) ? 'active bg-primary text-white rounded' : ''; ?>" href="{{ route('produits.index')}}" >
                          <i class="fas fa-box p-2"></i>
                          <span class="hide-text">Produits</span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link text-white <?php echo (request()->is('fournisseurs')) ? 'active rounded' : ''; ?>" href="{{ route('fournisseurs.index')}}" id="menu-fournisseur">
                          <i class="fas fa-truck p-2"></i>
                          <span class="hide-text">Fournisseurs</span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link text-white <?php echo (request()->is('vente*')) ? 'active rounded' : ''; ?>" href="{{ route('ventes.index')}}" id="menu-vente">
                          <i class="fas fa-shopping-cart p-2"></i>
                          <span class="hide-text p-2">Ventes</span></a>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link text-white <?php echo (request()->is('commandes')) ? 'active rounded' : ''; ?>" href="{{ route('commandes.index')}}" id="menu-commandes">
                          <i class="fas fa-clipboard-list p-2"></i>
                          <span class="hide-text">Commandes</span></a>
                      </a>
                  </li>
              </ul>
              <div class="sidebar-bottom">
                <div class="user">
                  <i class="fa-solid fa-circle-user fa-xl m-2" style="color: #ffffff;"></i>
                  <span style="color: white">
                    {{ auth()->user()->name }}
                  </span>
                </div>
              </div>
          </div>







            <main class="col-10 px-md-4">
              <nav class="navbar navbar-expand-lg" id="nav2">
                  <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                      {{-- <img src="../images/image2.png" alt="Mon site logo" width="100" height="30"> --}}
                      <strong><b class="text-white">AI<span class="text-dark">KA</span></b></strong>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                      <ul class="navbar-nav">
                        <li class="nav-item notification-icon">
                          <a id="low-quantity-products-link" class="nav-link position-relative btn btn-outline-light" data-action="low-quantity-products">
                            <i class="fa fa-bell"></i> Notification
                            @if($count_low_q > 0)
                                <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill badge-danger bg-danger">{{ $count_low_q}}</span>
                            @endif
                          </a>
                        </li>

                        @guest
                        <li class="nav-item">
                          <a class="nav-link   btn btn-outline-light" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i> Se connecter
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link  btn btn-outline-light" href="{{ route('register') }}">
                            <i class="fas fa-user-plus"></i> S'inscrire
                          </a>
                        </li>
                        @else
                        <li class="nav-item">
                          <a class="nav-link  btn btn-outline-light" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out-alt"></i> Se déconnecter
                          </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                          </form>
                        </li>
                        @endguest
                      </ul>
                    </div>

                  </div>
                </nav>


                <div class="py-4">
                  @yield('content')
                </div>
              </main>
          </div>
      </div>
      <div class="modal fade" id="low-quantity-products-modal" tabindex="-1" aria-labelledby="low-quantity-products-modal-label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="low-quantity-products-modal-label">Produits avec une quantité inférieure à 10</h5>
              <button type="button" data-bs-dismiss="modal" aria-label="Close">
                <i class="fa-solid fa-xmark"></i>
              </button>

            </div>
            <div class="modal-body">
              <p>Les produits suivants ont une quantité inférieure à 10 :</p>
              <ul></ul>
            </div>
          </div>
        </div>
      </div>

      <script>
        $('.notification-icon').click(function(event) {
            event.preventDefault();
            $.get('/low-quantity-products', function(response) {
              if (response.products.length > 0) {
                    var message = '<ul>';
                    $.each(response.products, function(index, product) {
                        message += '<li>' +"- "+ product +'. </li>';
                    });
                    message += '</ul>';
                    $('#low-quantity-products-modal .modal-body').html( '<b>' + message +'<b>');
                    $('#low-quantity-products-modal').modal('show');
                  } else {
                    alert('Tous les produits ont une quantité suffisante.');
                  }
                });
        });
        </script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="https://kit.fontawesome.com/e6515fe9c1.js" crossorigin="anonymous"></script>
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> --}}

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $('.js-example-basic-single').select2({
  });
</script>
</body>

</html>
