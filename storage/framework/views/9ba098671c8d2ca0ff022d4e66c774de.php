<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="<?php echo e(asset('/css/app.css')); ?>" rel="stylesheet" />
    <title><?php echo $__env->yieldContent('title', 'My Laravel App'); ?></title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-4"> 
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?php echo e(route('home.index')); ?>">
                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo ZUCA" class="custom-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <?php if(auth()->guard()->guest()): ?>
                        <?php if(Route::has('login')): ?>
                            <a class="nav-link active" href="<?php echo e(route('login')); ?>">Login</a>
                        <?php endif; ?>
                        <?php if(Route::has('register')): ?>
                            <a class="nav-link active" href="<?php echo e(route('register')); ?>">Register</a>
                        <?php endif; ?>
                    <?php else: ?>
                        <p class="nav-link active text-white">Your balance: <?php echo e(Auth::user()->getBalance()); ?></p>
                        <a class="nav-link active" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <?php if(Auth::user()->getRole() === 'admin'): ?>
                            <a class="nav-link active" href="<?php echo e(route('admin.home.index')); ?>">Admin Panel</a>
                        <?php endif; ?>
                        <a class="nav-link active" href="<?php echo e(route('cart.index')); ?>">Cart of Products</a>
                        <a class="nav-link active" href="<?php echo e(route('order.index')); ?>">My orders</a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo csrf_field(); ?>
                        </form>
                    <?php endif; ?>
                    <a class="nav-link active" href="<?php echo e(route('product.index')); ?>">Products</a>
                    <a class="nav-link active" href="<?php echo e(route('product.partnerProducts')); ?>">Partner Products</a>


                </div>
            </div>
        </div>
    </nav>

    <header class="masthead text-white text-center py-2" style="background-color: #333;">
        <div class="container d-flex align-items-center flex-column">
            <h1 class="display-6" style="font-size: 1.75rem;"><?php echo $__env->yieldContent('subtitle', 'Welcome to My Laravel App'); ?></h1>
        </div>
    </header>
    
    <div class="container my-4">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <footer class="py-4 bg-dark text-white text-center">
        <div class="container">
            <small>
                Copyright &copy; <?php echo e(date('Y')); ?> - My Laravel App
            </small>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Zuca\resources\views/layouts/app.blade.php ENDPATH**/ ?>