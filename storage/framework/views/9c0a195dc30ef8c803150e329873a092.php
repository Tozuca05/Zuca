<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
          crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="<?php echo e(asset('/css/admin.css')); ?>" rel="stylesheet" />
    <title><?php echo $__env->yieldContent('title', 'Admin Panel - Online Store'); ?></title>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
                <div class="position-sticky pt-3">
                    <a href="<?php echo e(route('admin.home.index')); ?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-4">Admin Panel</span>
                    </a>
                    <hr class="text-white" />
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.home.index')); ?>" class="nav-link text-white">
                                <i class="bi bi-house-door me-2"></i>Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.product.index')); ?>" class="nav-link text-white">
                                <i class="bi bi-box me-2"></i>Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.tag.index')); ?>" class="nav-link text-white">
                                <i class="bi bi-tags me-2"></i>Tags
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.item.topSoldProducts')); ?>" class="nav-link text-white">
                                <i class="bi bi-graph-up me-2"></i>Statistics
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.playlist.index')); ?>" class="nav-link text-white">
                                <i class="bi bi-music-note-list me-2"></i>Playlists
                            </a>
                        </li>
                    </ul>
                    <hr class="text-white" />
                    <div class="d-grid gap-2">
                        <a href="<?php echo e(route('home.index')); ?>" class="btn btn-primary">Go to Main Page</a>
                        <a href="<?php echo e(route('product.index')); ?>" class="btn btn-secondary">Product List</a>
                    </div>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><?php echo $__env->yieldContent('header', 'Admin Panel'); ?></h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <span class="profile-font me-2">Admin</span>
                            <img class="img-profile rounded-circle" src="<?php echo e(asset('/images/admin.png')); ?>" alt="Admin Profile" width="32" height="32">
                        </div>
                    </div>
                </div>
                <div class="content-wrapper">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </main>
        </div>
    </div>

    <footer class="footer mt-auto py-3 bg-dark text-white text-center">
        <div class="container">
            <small>
                Copyright &copy; <?php echo e(date('Y')); ?> - My Laravel Application
            </small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous">
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\Zuca\resources\views/layouts/admin.blade.php ENDPATH**/ ?>