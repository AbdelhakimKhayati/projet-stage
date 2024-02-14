<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Liens CSS de Bootstrap -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Styles pour la page de login */
    body {
      background: url('../images/image.jpg') no-repeat center center fixed;
      background-size: cover;
    }
    a {
    text-decoration: none;
    }
    .login-page {
        width: 100%;
        height: 100vh;
        display: inline-block;
        display: flex;
        align-items: center;
    }
    .form-right i {
        font-size: 100px;
    }
    #divimg {
        background: url('../images/image2.png') ;
        background-size: cover; 
    }
    </style>
</head>
<body>
    <div class="login-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                  <h3 class="mb-3 text-white " style="text-shadow: 2px 2px 4px #000000;">Crée Compte</h3>
                    <div class="bg-white shadow rounded">
                        <div class="row">
                            <div class="col-md-7 pe-0">
                                <div class="form-left h-100 py-5 px-5">
                                    <form method="POST" action="{{ route('register') }}" class="row g-4">
                                        @csrf
                                            <div class="col-12">
                                            <label for="name">Nom<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fa-solid fa-user"></i></div>
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="entrez votre nom" required autocomplete="name" autofocus>
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            </div>
                                            <div class="col-12">
                                                <label>Email Address<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="fa-solid fa-at"></i></div>
                                                    <input id="email" type="email" placeholder="Entrez Email Address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
    
                                            <div class="col-12">
                                                <label>mot de passe<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="fa-solid fa-lock"></i></div>
                                                    <input id="password" type="password" placeholder="Entrer le mot de passe" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label> Confirm le mot de passe<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="fa-solid fa-lock"></i></div>
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmez le mot de passe" required autocomplete="new-password">
                                                    @error('password_confirmation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <a class="btn btn-link" href="{{ route('login') }}">
                                                    {{ __('Avez vous déjà un compte') }}
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <button type="submit" class="btn btn-primary px-4 float-end mt-4">Register</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-5 ps-0 d-none d-md-block">
                                <div class="form-right h-100 bg-primary text-white text-center pt-5" id="divimg">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="https://kit.fontawesome.com/e6515fe9c1.js" crossorigin="anonymous"></script>
</body>
</html>