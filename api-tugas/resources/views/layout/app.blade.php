<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Data Mahasiswa')</title>
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            color: #333;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 260px;
            height: 100vh;
            background-color: #2c3e50;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            transition: all 0.3s;
            overflow-y: auto;
            border-right: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-brand {
            padding: 25px 20px;
            font-size: 20px;
            font-weight: 800;
            background-color: #1a252f;
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            text-decoration: none;
            letter-spacing: 0.5px;
        }

        .sidebar-brand i {
            color: #3498db;
        }

        .sidebar-header {
            padding: 20px 20px 10px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #bdc3c7;
            font-weight: 700;
            opacity: 0.7;
        }

        .nav-link {
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.7) !important;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.2s;
            margin: 2px 15px;
            border-radius: 6px;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white !important;
            padding-left: 25px;
        }

        .nav-link.active {
            background-color: #3498db;
            color: white !important;
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
        }

        .nav-link i {
            font-size: 18px;
            width: 24px;
            text-align: center;
        }

        /* Main Content Styling */
        .main-content {
            margin-left: 260px;
            padding: 0;
            min-height: 100vh;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
        }

        /* Top Header Area */
        .top-header {
            background: white;
            height: 70px;
            padding: 0 30px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #2c3e50;
            font-weight: 600;
            padding: 8px 15px;
            border-radius: 50px;
            transition: all 0.2s;
            border: 1px solid #f1f2f6;
        }

        .user-profile:hover {
            background-color: #f8f9fa;
        }

        .content-body {
            padding: 30px;
            flex: 1;
        }

        /* Container & Card Styling */
        .card-custom {
            background: white;
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            margin: 0;
        }

        /* Dropdown Menu Styling (Sidebar) */
        .dropdown-menu {
            background-color: white;
            border: none;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 10px;
            margin-top: 10px !important;
        }

        .dropdown-item {
            color: #2c3e50;
            padding: 10px 15px;
            border-radius: 6px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #3498db;
        }

        .dropdown-item i {
            color: #3498db;
            font-size: 16px;
        }

        /* Responsive */
        /* Sidebar backdrop on mobile */
        .sidebar-backdrop {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }
        .sidebar-backdrop.show { display: block; }

        /* Hamburger button */
        .hamburger-btn {
            background: none;
            border: none;
            font-size: 28px;
            color: #2c3e50;
            cursor: pointer;
            padding: 4px 8px;
            display: none;
            line-height: 1;
        }

        @media (max-width: 992px) {
            .sidebar { left: -260px; }
            .main-content { margin-left: 0; }
            .sidebar.active { left: 0; }
            .hamburger-btn { display: inline-flex; }
            .top-header { padding: 0 15px; gap: 10px; }
            .top-header > .dropdown { margin-left: auto; }
            .content-body { padding: 15px; }
            .title-page { font-size: 20px; padding: 15px; }
            .header-section { flex-wrap: wrap; gap: 10px; padding: 15px; }
            .header-section .btn { width: 100%; justify-content: center; }
            .table thead th, .table tbody td { padding: 10px 12px; font-size: 13px; white-space: nowrap; }
        }

        @media (max-width: 576px) {
            .content-body { padding: 10px; }
            .title-page { font-size: 17px; padding: 12px; }
            .header-section { padding: 12px; }
            .table thead th, .table tbody td { padding: 8px 10px; font-size: 12px; }
        }

        /* UI Components Preservation */
        .title-page { color: #2c3e50; font-weight: 800; font-size: 26px; margin-bottom: 25px; padding: 25px; border-bottom: 1px solid #f1f2f6; }
        .header-section { display: flex; justify-content: space-between; align-items: center; padding: 25px; border-bottom: 1px solid #f1f2f6; }
        .header-section .title-page { margin-bottom: 0; border: none; padding: 0; }
        
        /* Table Enhancement */
        .table-responsive { border-radius: 0 0 10px 10px; overflow: hidden; }
        .table thead { background-color: #f8f9fa; color: #2c3e50; }
        .table thead th { border-bottom: 2px solid #f1f2f6; padding: 15px 20px; font-weight: 700; color: #2c3e50; }
        .table tbody td { padding: 15px 20px; vertical-align: middle; border-bottom: 1px solid #f1f2f6; }
        
        .btn-primary { background-color: #3498db; border: none; box-shadow: 0 4px 10px rgba(52, 152, 219, 0.2); }
        .btn-primary:hover { background-color: #2980b9; transform: translateY(-1px); }
        
        footer { padding: 25px; text-align: center; color: #95a5a6; font-size: 14px; font-weight: 500; }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="{{ route('data-mahasiswa') }}" class="sidebar-brand">
            <i class="bi bi-mortarboard-fill"></i>
            <span>SISTEM DATA</span>
        </a>

        <div class="sidebar-header">Main Menu</div>
        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
            <i class="bi bi-house-door"></i>
            <span>Dashboard</span>
        </a>
        <a class="nav-link {{ request()->is('data-mahasiswa*') ? 'active' : '' }}" href="{{ route('data-mahasiswa') }}">
            <i class="bi bi-people"></i>
            <span>Data Mahasiswa</span>
        </a>

        @auth
        @unless(Auth::user()->hasRole('mahasiswa'))
        <div class="sidebar-header">Master Data</div>
        <a class="nav-link {{ request()->is('data-dosen*') ? 'active' : '' }}" href="{{ route('dosen.index') }}">
            <i class="bi bi-person-badge"></i>
            <span>Data Dosen</span>
        </a>
        @endunless
        @endauth
        <a class="nav-link {{ request()->is('data-mata-kuliah*') ? 'active' : '' }}" href="{{ route('mata-kuliah.index') }}">
            <i class="bi bi-book"></i>
            <span>Mata Kuliah</span>
        </a>
        <a class="nav-link {{ request()->is('data-tahun-akademik*') ? 'active' : '' }}" href="{{ route('tahun-akademik.index') }}">
            <i class="bi bi-calendar3"></i>
            <span>Tahun Akademik</span>
        </a>
        <a class="nav-link {{ request()->is('data-bimbingan*') ? 'active' : '' }}" href="{{ route('bimbingan.index') }}">
            <i class="bi bi-chat-dots"></i>
            <span>Data Bimbingan</span>
        </a>
        <a class="nav-link {{ request()->is('data-lengkap-mahasiswa*') ? 'active' : '' }}" href="{{ route('data-lengkap-mahasiswa.index') }}">
            <i class="bi bi-person-lines-fill"></i>
            <span>Data Lengkap</span>
        </a>

        <div class="sidebar-header">Prestasi</div>
        <a class="nav-link {{ request()->is('data-referensi-kejuaraan*') ? 'active' : '' }}" href="{{ route('referensi-kejuaraan.index') }}">
            <i class="bi bi-trophy"></i>
            <span>Referensi Kejuaraan</span>
        </a>
        <a class="nav-link {{ request()->is('data-pendaftaran-prestasi*') ? 'active' : '' }}" href="{{ route('pendaftaran-prestasi.index') }}">
            <i class="bi bi-clipboard-check"></i>
            <span>Pendaftaran</span>
        </a>
        <a class="nav-link {{ request()->is('data-capaian-prestasi*') ? 'active' : '' }}" href="{{ route('capaian-prestasi.index') }}">
            <i class="bi bi-award"></i>
            <span>Capaian Prestasi</span>
        </a>

        @if(Auth::check() && (Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('administrator') || Auth::user()->hasRole('admin')))
        <div class="sidebar-header">Administration</div>
        <a class="nav-link {{ request()->is('hak-akses/users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
            <i class="bi bi-people-fill"></i>
            <span>Manajemen User</span>
        </a>
        <a class="nav-link {{ request()->is('roles*') ? 'active' : '' }}" href="{{ route('roles.index') }}">
            <i class="bi bi-shield-lock"></i>
            <span>Hak Akses</span>
        </a>
        @endif
    </div>

    <!-- Sidebar Backdrop -->
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Header Area -->
        <div class="top-header">
            <button class="hamburger-btn" id="sidebarToggle" aria-label="Toggle sidebar">
                <i class="bi bi-list"></i>
            </button>
            @auth
            <div class="dropdown">
                <div class="user-profile dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle fs-5"></i>
                    <span>{{ Auth::user()->name }}</span>
                    <i class="bi bi-chevron-down ms-1 fs-xs"></i>
                </div>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li class="px-3 py-2 border-bottom mb-2">
                        <div class="fw-bold">{{ Auth::user()->name }}</div>
                        <small class="text-muted">{{ Auth::user()->email }}</small>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
            @endauth
        </div>

        <div class="content-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="bi bi-exclamation-circle"></i> Terjadi kesalahan!</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card card-custom">
                @yield('content')
            </div>

            <footer>
                <p class="mb-0">&copy; 2026 Sistem Data Mahasiswa • <i class="bi bi-code-slash"></i> with Love</p>
            </footer>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.querySelector('.sidebar');
            const toggleBtn = document.getElementById('sidebarToggle');
            const backdrop = document.getElementById('sidebarBackdrop');

            if (toggleBtn && sidebar && backdrop) {
                toggleBtn.addEventListener('click', function () {
                    sidebar.classList.toggle('active');
                    backdrop.classList.toggle('show');
                });

                backdrop.addEventListener('click', function () {
                    sidebar.classList.remove('active');
                    backdrop.classList.remove('show');
                });
            }
        });
    </script>
</body>
</html>
