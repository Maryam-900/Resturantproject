<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Rustic Eats - Restaurant')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --bg-dark: #1a1a1a;
            --bg-darker: #0f0f0f;
            --bg-card: #242424;
            --primary: #6B8E23;
            --primary-hover: #5a7a1d;
            --secondary: #A0522D;
            --accent: #FFD580;
            --text-light: #e0e0e0;
            --text-muted: #a0a0a0;
            --border-color: #333;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }

        .navbar {
            background-color: var(--bg-darker) !important;
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 0;
        }

        .navbar-brand {
            color: var(--primary) !important;
            font-weight: 700;
            font-size: 1.8rem;
        }

        .nav-link {
            color: var(--text-light) !important;
            font-weight: 500;
            margin: 0 0.5rem;
            transition: all 0.3s;
        }

        .nav-link:hover {
            color: var(--primary) !important;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            color: white;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            transform: translateY(-2px);
        }

        .btn-outline-primary {
            border-color: var(--primary);
            color: var(--primary);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            transition: all 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(107, 142, 35, 0.2);
        }

        .card-title {
            color: var(--text-light);
        }

        .card-text {
            color: var(--text-muted);
        }

        .form-control, .form-select {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            color: var(--text-light);
        }

        .form-control:focus, .form-select:focus {
            background-color: var(--bg-card);
            border-color: var(--primary);
            color: var(--text-light);
            box-shadow: 0 0 0 0.2rem rgba(107, 142, 35, 0.25);
        }

        .form-label {
            color: var(--text-light);
        }

        .badge {
            padding: 0.5rem 0.8rem;
        }

        .alert {
            border-radius: 8px;
            border: none;
        }

        .alert-success {
            background-color: rgba(107, 142, 35, 0.2);
            color: var(--primary);
            border-left: 4px solid var(--primary);
        }

        .alert-danger {
            background-color: rgba(220, 53, 69, 0.2);
            color: #ff6b6b;
            border-left: 4px solid #ff6b6b;
        }

        footer {
            background-color: var(--bg-darker);
            color: var(--text-muted);
            padding: 3rem 0;
            margin-top: 5rem;
            border-top: 1px solid var(--border-color);
        }

        footer h5 {
            color: var(--text-light);
        }

        footer a {
            color: var(--accent);
            text-decoration: none;
        }

        footer a:hover {
            color: var(--primary);
        }

        .dropdown-menu {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
        }

        .dropdown-item {
            color: var(--text-light);
        }

        .dropdown-item:hover {
            background-color: var(--bg-darker);
            color: var(--primary);
        }

        .table {
            color: var(--text-light);
        }

        .table-dark {
            --bs-table-bg: var(--bg-card);
            --bs-table-border-color: var(--border-color);
        }

        /* Ensure all text is visible */
        h1, h2, h3, h4, h5, h6, p, span, div, label, a {
            color: var(--text-light);
        }

        .text-muted {
            color: var(--text-muted) !important;
        }

        .text-primary {
            color: var(--primary) !important;
        }

        /* Fix card text visibility */
        .card-body h5, .card-body h6, .card-body p, .card-body div {
            color: var(--text-light);
        }

        /* Timeline text */
        .timeline-content h5, .timeline-content p {
            color: var(--text-light);
        }

        /* Order items */
        .order-items {
            color: var(--text-light);
        }

        /* Ensure strong tags are visible */
        strong {
            color: var(--text-light);
        }

        /* Small text */
        small {
            color: var(--text-muted);
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="bi bi-tree-fill me-2"></i>Rustic Eats
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('menu') }}">Menu</a>
                    </li>
                    
                    @auth
                        @if(auth()->user()->role === 'user')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cart.index') }}">
                                    Cart <span class="badge bg-primary">{{ \App\Models\Cart::where('user_id', auth()->id())->count() }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('orders.history') }}">Orders</a>
                            </li>
                        @endif

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                @if(auth()->user()->role === 'admin')
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Sign In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Alerts -->
    @if(session('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>Rustic Eats</h5>
                    <p>Fresh ingredients, rustic flavors, and natural goodness in every bite.</p>
                    <div class="social-links">
                        <a href="#" class="me-3"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="me-3"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="me-3"><i class="bi bi-twitter"></i></a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Contact Info</h5>
                    <p><i class="bi bi-geo-alt me-2"></i> 123 Nature Lane, Green Valley</p>
                    <p><i class="bi bi-telephone me-2"></i> (555) 123-4567</p>
                    <p><i class="bi bi-envelope me-2"></i> info@rusticeats.com</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Opening Hours</h5>
                    <p>Monday - Friday: 11am - 10pm</p>
                    <p>Saturday - Sunday: 10am - 11pm</p>
                </div>
            </div>
            <hr class="my-4" style="border-color: var(--border-color);">
            <div class="text-center">
                <p>&copy; 2024 Rustic Eats. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
