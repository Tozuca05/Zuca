<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    
    <!-- CSS personalizado -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
    
    <title>@yield('title', 'My Laravel App')</title>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary py-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home.index') }}">My App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <!-- Enlaces de autenticación -->
                    @guest
                        @if (Route::has('login'))
                            <a class="nav-link active" href="{{ route('login') }}">Login</a>
                        @endif
                        @if (Route::has('register'))
                            <a class="nav-link active" href="{{ route('register') }}">Register</a>
                        @endif
                        
                        @else
                        <a class="nav-link active" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        @if (Auth::user()->getRole() === 'admin')
                        <a class="nav-link active" href="{{ route('admin.home.index') }}">Admin Panel</a>
                        @endif
                        <a class="nav-link active" href="{{ route('cart.index') }}">Cart of Products</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endguest
                        <a class="nav-link active" href="{{ route('product.index') }}">Products</a>
                </div>
            </div>
        </div>
    </nav>

    <header class="masthead bg-primary text-white text-center py-4">
        <div class="container d-flex align-items-center flex-column">
            <h2>@yield('subtitle', 'Welcome to My Laravel App')</h2>
        </div>
    </header>
    <!-- End Header -->

    <!-- Main content -->
    <div class="container my-4">
        @yield('content')
    </div>

    <!-- Footer -->
    <div class="copyright py-4 text-center text-white">
        <div class="container">
            <small>
                Copyright &copy; {{ date('Y') }} - My Laravel App
            </small>
        </div>
    </div>
    <!-- End Footer -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
