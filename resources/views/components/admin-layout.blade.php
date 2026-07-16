@props(['title' => 'Admin', 'active' => null])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} — SemanticFuture Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <form action="{{ route('admin.logout') }}" method="post" class="d-inline">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link" style="border:0; background:none;">Logout</button>
                </form>
            </li>
        </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('admin.dashboard') }}" class="brand-link"><span class="brand-text font-weight-light">SemanticFuture Admin</span></a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ $active === 'dashboard' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i><p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.ebooks.index') }}" class="nav-link {{ $active === 'ebooks' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i><p>Digital Products</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.blog.index') }}" class="nav-link {{ $active === 'blog' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-pen"></i><p>Blog Posts</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.analytics') }}" class="nav-link {{ $active === 'analytics' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-chart-line"></i><p>Analytics</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <div class="content-wrapper p-4">
        <div class="content-header">
            <h1>{{ $title }}</h1>
        </div>
        <div class="content">
            {{ $slot }}
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
{{ $scripts ?? '' }}
</body>
</html>
