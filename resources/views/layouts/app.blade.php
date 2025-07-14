<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #6b7280;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --info-color: #3b82f6;
            --light-color: #f8fafc;
            --dark-color: #1f2937;
        }
        
        body {
            background-color: #f1f5f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--primary-color), #6366f1) !important;
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }
        
        .navbar-brand:hover {
            color: rgba(255, 255, 255, 0.8) !important;
        }
        
        .container-fluid {
            max-width: 1400px;
        }
        
        .card {
            border-radius: 12px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .btn {
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), #6366f1);
            border: none;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #4338ca, #5b21b6);
            transform: translateY(-1px);
        }
        
        .table-dark {
            background: linear-gradient(135deg, var(--dark-color), #374151);
        }
        
        .pagination .page-link {
            border-radius: 6px;
            margin: 0 2px;
            border: none;
            color: var(--primary-color);
        }
        
        .pagination .page-link:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        footer {
            background: linear-gradient(135deg, var(--dark-color), #374151);
            color: white;
            margin-top: auto;
        }
        
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
  </head>
  <body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-gamepad me-2"></i>
                G4ME Pro Africa
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                          <i class="fas fa-tachometer-alt me-1"></i>
                          Dashboard
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{ request()->routeIs('admin.leads') ? 'active' : '' }}" href="{{ route('admin.leads') }}">
                            <i class="fas fa-users me-1"></i>
                            Leads
                        </a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link {{ request()->routeIs('admin.analytics') ? 'active' : '' }}" href="{{ route('admin.analytics') }}">
                            <i class="fas fa-chart-bar me-1"></i>
                            Analytics
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <main class="flex-grow-1 animate-fade-in">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center py-4 mt-5">
        <div class="container">
            <p class="mb-0">
                <i class="fas fa-heart text-danger me-1"></i>
                &copy; {{ date('Y') }} G4ME Pro Africa — Tous droits réservés
            </p>
        </div>
    </footer>
    @stack('scripts')
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>

</html>