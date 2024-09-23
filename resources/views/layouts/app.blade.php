<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
    <title>@yield('title', 'My Laravel App')</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-4"> 
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home.index') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo ZUCA" class="custom-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
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
                        <a class="nav-link active" href="{{ route('order.index') }}">My Orders</a> <!-- Nuevo botón aquí -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endguest
                    <a class="nav-link active" href="{{ route('product.index') }}">Products</a>
                </div>
            </div>
        </div>
    </nav>

    <header class="masthead text-white text-center py-2" style="background-color: #333;">
        <div class="container d-flex align-items-center flex-column">
            <h1 class="display-6" style="font-size: 1.75rem;">@yield('subtitle', 'Welcome to My Laravel App')</h1>
        </div>
    </header>
    
    <div class="container my-4">
        @yield('content')
    </div>

    <footer class="py-4 bg-dark text-white text-center">
        <div class="container">
            <small>
                Copyright &copy; {{ date('Y') }} - My Laravel App
            </small>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    @yield('scripts')
</body>
</html>
