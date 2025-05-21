<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management - @yield('title')</title>

    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Google Fonts - Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --accent-color: #e74c3c;
            --light-gray: #f8f9fa;
            --dark-gray: #343a40;
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 80px;
            --transition-speed: 0.3s;
        }
        
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f7fa;
            color: #333;
            overflow-x: hidden;
        }
        
        /* Sidebar */
        .sidebar {
            background-color: var(--secondary-color);
            color: white;
            min-height: 150vh;
            width: var(--sidebar-width);
            position: fixed;
            transition: all var(--transition-speed) ease;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .sidebar-collapsed {
            width: var(--sidebar-collapsed-width);
        }
        
        .sidebar-collapsed .sidebar-brand,
        .sidebar-collapsed .nav-link-text {
            display: none;
        }
        
        .sidebar-collapsed .nav-link {
            justify-content: center;
        }
        
        .sidebar-brand {
            padding: 1.5rem 1rem;
            font-size: 1.25rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            color: white;
            text-decoration: none;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-brand i {
            margin-right: 0.75rem;
            font-size: 1.5rem;
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 1 1rem;
            margin: 0.25rem 0.5rem;
            border-radius: 4px;
            display: flex;
            align-items: center;
            transition: all 0.2s ease;
        }
        
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            text-decoration: none;
        }
        
        .nav-link.active {
            background-color: var(--primary-color);
            color: white;
            font-weight: 500;
        }
        
        .nav-link i {
            font-size: 1.1rem;
            margin-right: 0.75rem;
            width: 24px;
            text-align: center;
        }
        
        .sub-menu {
            padding-left: 0.5rem;
        }
        
        .sub-menu .nav-link {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            margin-left: 1.5rem;
            border-left: 2px solid rgba(255, 255, 255, 0.1);
        }
        
        .sub-menu .nav-link.active {
            border-left-color: var(--primary-color);
        }
        
        .menu-arrow {
            margin-left: auto;
            transition: transform 0.2s ease;
        }
        
        .menu-arrow.rotated {
            transform: rotate(180deg);
        }
        
        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            transition: margin-left var(--transition-speed) ease;
        }
        
        .main-content-collapsed {
            margin-left: var(--sidebar-collapsed-width);
        }
        
        /* Navbar */
        .top-navbar {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 0.75rem 1.5rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .toggle-sidebar-btn {
            border: none;
            background: none;
            color: var(--dark-gray);
            font-size: 1.25rem;
            cursor: pointer;
            margin-right: 1rem;
        }
        
        .user-dropdown .dropdown-toggle {
            display: flex;
            align-items: center;
        }
        
        .user-dropdown .dropdown-toggle::after {
            margin-left: 0.5rem;
        }
        
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.5rem;
            font-weight: 500;
        }
        
        /* Page Content */
        .page-container {
            padding: 2rem;
        }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .page-title {
            font-weight: 500;
            color: var(--secondary-color);
            margin: 0;
        }
        
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid #e0e0e0;
            font-weight: 500;
            padding: 1rem 1.5rem;
        }
        
        /* Buttons */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
        }
        
        /* Alerts */
        .alert {
            border-radius: 4px;
            padding: 0.75rem 1.25rem;
        }
        
        /* Table */
        .table {
            border-radius: 4px;
            overflow: hidden;
        }
        
        .table thead th {
            background-color: #f8f9fa;
            border-bottom-width: 1px;
            font-weight: 500;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 1050;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 1040;
                display: none;
            }
            
            .overlay.show {
                display: block;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar Overlay (Mobile) -->
    <div class="overlay"></div>

    <!-- Sidebar -->
    <aside class="sidebar">
        <a href="{{ route('dashboard') }}" class="sidebar-brand">
            <i class="bi bi-box-seam"></i>
            <span class="nav-link-text">InventoryPro</span>
        </a>
        
        <ul class="nav flex-column mt-3">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="bi bi-speedometer2"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->is('stocks*') ? 'active' : '' }}" href="{{ route('stocks.index') }}">
                    <i class="bi bi-boxes"></i>
                    <span class="nav-link-text">Stock</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->is('invoices*') ? 'active' : '' }}" href="{{ route('invoices.index') }}">
                    <i class="bi bi-receipt"></i>
                    <span class="nav-link-text">Sales</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->is('payments*') ? 'active' : '' }}" href="{{ route('payments.index') }}">
                    <i class="bi bi-credit-card"></i>
                    <span class="nav-link-text">Payments</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->is('reports*') ? 'active' : '' }} {{ request()->is('reports*') ? '' : 'collapsed' }}" 
                   data-bs-toggle="collapse" 
                   href="#reportsMenu" 
                   aria-expanded="{{ request()->is('reports*') ? 'true' : 'false' }}">
                    <i class="bi bi-file-earmark-bar-graph"></i>
                    <span class="nav-link-text">Reports</span>
                    <i class="bi bi-chevron-down menu-arrow {{ request()->is('reports*') ? 'rotated' : '' }}"></i>
                </a>
                <div class="collapse {{ request()->is('reports*') ? 'show' : '' }}" id="reportsMenu">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('reports/customer') ? 'active' : '' }}" href="{{ route('reports.customer') }}">
                                <i class="bi bi-person-lines-fill"></i>
                                <span class="nav-link-text">Customer</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('reports/product') ? 'active' : '' }}" href="{{ route('reports.product') }}">
                                <i class="bi bi-box-seam"></i>
                                <span class="nav-link-text">Product</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->is('products*', 'packsizes*', 'vendors*', 'customers*', 'types*') ? 'active' : '' }} {{ request()->is('products*', 'packsizes*', 'vendors*', 'customers*', 'types*') ? '' : 'collapsed' }}" 
                   data-bs-toggle="collapse" 
                   href="#settingsMenu" 
                   aria-expanded="{{ request()->is('products*', 'packsizes*', 'vendors*', 'customers*', 'types*') ? 'true' : 'false' }}">
                    <i class="bi bi-gear"></i>
                    <span class="nav-link-text">Settings</span>
                    <i class="bi bi-chevron-down menu-arrow {{ request()->is('products*', 'packsizes*', 'vendors*', 'customers*', 'types*') ? 'rotated' : '' }}"></i>
                </a>
                <div class="collapse {{ request()->is('products*', 'packsizes*', 'vendors*', 'customers*', 'types*') ? 'show' : '' }}" id="settingsMenu">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('products*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                                <i class="bi bi-tags"></i>
                                <span class="nav-link-text">Products</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('packsizes*') ? 'active' : '' }}" href="{{ route('packsizes.index') }}">
                                <i class="bi bi-box"></i>
                                <span class="nav-link-text">Pack Sizes</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('vendors*') ? 'active' : '' }}" href="{{ route('vendors.index') }}">
                                <i class="bi bi-building"></i>
                                <span class="nav-link-text">Vendors</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('customers*') ? 'active' : '' }}" href="{{ route('customers.index') }}">
                                <i class="bi bi-people"></i>
                                <span class="nav-link-text">Customers</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('types*') ? 'active' : '' }}" href="{{ route('types.index') }}">
                                <i class="bi bi-list-ul"></i>
                                <span class="nav-link-text">Types</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navbar -->
        <nav class="top-navbar navbar navbar-expand-lg navbar-light bg-white">
            <div class="d-flex align-items-center">
                <button class="toggle-sidebar-btn d-lg-none me-2">
                    <i class="bi bi-list"></i>
                </button>
                <button class="toggle-sidebar-btn d-none d-lg-block me-3">
                    <i class="bi bi-list"></i>
                </button>
                <span class="d-none d-md-inline">Welcome back, {{ Auth::user()->name }}</span>
            </div>
            
            <div class="ms-auto d-flex align-items-center">
                <div class="dropdown user-dropdown">
                    <a class="dropdown-toggle d-flex align-items-center" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-avatar">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i> Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i> Log Out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="page-container">
            <div class="page-header">
                <h1 class="page-title">@yield('title')</h1>
                <div class="page-actions">
                    @yield('actions')
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any()))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    Please fix the following errors:
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle sidebar
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('.toggle-sidebar-btn');
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');
            const overlay = document.querySelector('.overlay');
            
            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                    overlay.classList.toggle('show');
                    
                    // For desktop - collapse/expand
                    if (window.innerWidth > 992) {
                        sidebar.classList.toggle('sidebar-collapsed');
                        mainContent.classList.toggle('main-content-collapsed');
                    }
                });
            });
            
            // Close sidebar when clicking overlay (mobile)
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            });
            
            // Keep parent menu open when child is active
            const parentMenus = document.querySelectorAll('.nav-link[data-bs-toggle="collapse"]');
            
            parentMenus.forEach(menu => {
                const target = menu.getAttribute('href');
                const collapseElement = document.querySelector(target);
                
                // Check if any child link is active
                const hasActiveChild = collapseElement.querySelector('.nav-link.active') !== null;
                
                if (hasActiveChild) {
                    menu.classList.add('active');
                    menu.setAttribute('aria-expanded', 'true');
                    menu.querySelector('.menu-arrow').classList.add('rotated');
                    
                    // Show the collapse element
                    const bsCollapse = new bootstrap.Collapse(collapseElement, {
                        toggle: false
                    });
                    bsCollapse.show();
                }
                
                // Rotate arrow when menu is toggled
                menu.addEventListener('click', function() {
                    const arrow = this.querySelector('.menu-arrow');
                    arrow.classList.toggle('rotated');
                });
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>