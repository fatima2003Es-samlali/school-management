<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --school-blue: #0d6efd;
            --school-blue-dark: #0a58ca;
            --school-soft: #f4f8ff;
        }

        body {
            background: var(--school-soft);
            color: #1f2937;
        }

        .app-shell {
            min-height: 100vh;
        }

        .app-sidebar,
        .app-rail {
            background: linear-gradient(180deg, var(--school-blue), var(--school-blue-dark));
            min-height: 100vh;
            position: sticky;
            top: 0;
        }

        .app-sidebar {
            width: 260px;
        }

        .app-rail {
            width: 92px;
        }

        .app-content {
            min-width: 0;
            flex: 1;
        }

        .app-topbar {
            min-height: 64px;
        }

        .sidebar-link {
            color: rgba(255, 255, 255, .86);
            border-radius: .7rem;
            display: flex;
            align-items: center;
            gap: .7rem;
            padding: .75rem .9rem;
            text-decoration: none;
            border: 1px solid transparent;
        }

        .sidebar-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, .14);
        }

        .sidebar-link.active {
            color: #fff;
            background: rgba(255, 255, 255, .24);
            border-color: rgba(255, 255, 255, .45);
            box-shadow: inset 4px 0 0 #fff;
        }

        .rail-link {
            color: rgba(255, 255, 255, .86);
            border-radius: .8rem;
            min-height: 64px;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: .2rem;
            font-size: .74rem;
            border: 1px solid transparent;
        }

        .rail-link i {
            font-size: 1.15rem;
        }

        .rail-link:hover,
        .rail-link.active {
            color: #fff;
            background: rgba(255, 255, 255, .22);
            border-color: rgba(255, 255, 255, .4);
        }

        .offcanvas .sidebar-link {
            color: #1f2937;
        }

        .offcanvas .sidebar-link:hover {
            color: var(--school-blue-dark);
            background: #edf4ff;
        }

        .offcanvas .sidebar-link.active {
            color: #fff;
            background: var(--school-blue);
            border-color: var(--school-blue);
            box-shadow: none;
        }

        .card {
            border: 0;
            border-radius: .75rem;
            box-shadow: 0 8px 24px rgba(13, 110, 253, .08);
        }

        .stat-card {
            overflow: hidden;
            position: relative;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 34px rgba(13, 110, 253, .14);
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            display: grid;
            place-items: center;
            border-radius: 1rem;
            color: #fff;
            font-size: 1.35rem;
            background: linear-gradient(135deg, var(--school-blue), #6ea8fe);
        }

        .chart-card {
            min-height: 360px;
        }

        .chart-box {
            position: relative;
            min-height: 260px;
        }

        .empty-state {
            border: 1px dashed #b6d4fe;
            background: #f8fbff;
            border-radius: .75rem;
            color: #6b7280;
        }

        .table {
            min-width: 720px;
        }

        .table thead th {
            background: #eaf2ff;
            color: var(--school-blue-dark);
            white-space: nowrap;
        }

        .btn-primary {
            background: var(--school-blue);
            border-color: var(--school-blue);
        }

        .form-control,
        .form-select {
            min-height: 42px;
        }

        @media (max-width: 767.98px) {
            .content-wrap {
                padding: 1rem !important;
            }

            .card {
                border-radius: .65rem;
            }

            .table {
                min-width: 640px;
            }
        }
    </style>
</head>
<body>
@auth
    @php
        $role = auth()->user()->role;
        $navItems = [
            [
                'label' => 'Dashboard',
                'short' => 'Home',
                'icon' => 'bi-speedometer2',
                'route' => $role.'.dashboard',
                'active' => $role.'.dashboard',
            ],
        ];

        if ($role === 'admin') {
            $navItems = array_merge($navItems, [
                ['label' => 'Classes', 'short' => 'Class', 'icon' => 'bi-building', 'route' => 'admin.classes.index', 'active' => 'admin.classes.*'],
                ['label' => 'Teachers', 'short' => 'Teach', 'icon' => 'bi-person-workspace', 'route' => 'admin.teachers.index', 'active' => 'admin.teachers.*'],
                ['label' => 'Students', 'short' => 'Stud', 'icon' => 'bi-people', 'route' => 'admin.students.index', 'active' => 'admin.students.*'],
                ['label' => 'Bibliotheque', 'short' => 'Books', 'icon' => 'bi-book', 'route' => 'admin.books.index', 'active' => 'admin.books.*'],
            ]);
        } elseif ($role === 'teacher') {
            $navItems = array_merge($navItems, [
                ['label' => 'Students', 'short' => 'Stud', 'icon' => 'bi-people', 'route' => 'teacher.students.index', 'active' => 'teacher.students.*'],
                ['label' => 'Devoirs', 'short' => 'Work', 'icon' => 'bi-journal-check', 'route' => 'teacher.assignments.index', 'active' => 'teacher.assignments.*'],
                ['label' => 'Bibliotheque', 'short' => 'Books', 'icon' => 'bi-book', 'route' => 'teacher.books.index', 'active' => 'teacher.books.*'],
            ]);
        } else {
            $navItems = array_merge($navItems, [
                ['label' => 'Devoirs', 'short' => 'Work', 'icon' => 'bi-journal-check', 'route' => 'student.assignments.index', 'active' => 'student.assignments.*'],
                ['label' => 'Bibliotheque', 'short' => 'Books', 'icon' => 'bi-book', 'route' => 'student.books.index', 'active' => 'student.books.*'],
            ]);
        }
    @endphp

    <div class="app-shell d-flex">
        <aside class="app-sidebar d-none d-xl-block p-3">
            <h4 class="text-white mb-4">School Manager</h4>
            <nav class="d-flex flex-column gap-2">
                @foreach($navItems as $item)
                    <a class="sidebar-link {{ request()->routeIs($item['active']) ? 'active' : '' }}" href="{{ route($item['route']) }}">
                        <i class="bi {{ $item['icon'] }}"></i>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>
        </aside>

        <aside class="app-rail d-none d-md-flex d-xl-none flex-column align-items-center p-2 gap-2">
            <div class="text-white fw-bold py-2">SM</div>
            @foreach($navItems as $item)
                <a class="rail-link w-100 {{ request()->routeIs($item['active']) ? 'active' : '' }}" href="{{ route($item['route']) }}" title="{{ $item['label'] }}">
                    <i class="bi {{ $item['icon'] }}"></i>
                    <span>{{ $item['short'] }}</span>
                </a>
            @endforeach
        </aside>

        <main class="app-content">
            <nav class="navbar app-topbar bg-white border-bottom px-3 px-md-4">
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-outline-primary d-xl-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu">
                        <i class="bi bi-list"></i>
                    </button>
                    <span class="navbar-brand mb-0 h6 text-primary">School Management</span>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="navbar-text d-none d-sm-inline">Bonjour, {{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-outline-primary btn-sm">Logout</button>
                    </form>
                </div>
            </nav>

            <div class="content-wrap p-3 p-md-4">
                @include('partials.flash')
                @yield('content')
            </div>
        </main>
    </div>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title text-primary" id="mobileMenuLabel">School Manager</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <nav class="d-flex flex-column gap-2">
                @foreach($navItems as $item)
                    <a class="sidebar-link {{ request()->routeIs($item['active']) ? 'active' : '' }}" href="{{ route($item['route']) }}">
                        <i class="bi {{ $item['icon'] }}"></i>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>
        </div>
    </div>
@else
    @yield('content')
@endauth
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
