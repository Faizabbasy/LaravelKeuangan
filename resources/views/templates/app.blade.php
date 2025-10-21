<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TabunganKu</title>
    <link rel="shortcut icon"
        href="https://asset.tix.id/wp-content/uploads/2021/11/Screen-Shot-2021-11-30-at-00.40.07-1200x760.png"
        type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.min.css" rel="stylesheet" />

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 100vh;
            width: 240px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #1137a1;
            color: white;
            padding-top: 20px;
            transition: 0.3s;
            z-index: 999;
        }

        .sidebar a {
            color: #cbd5e1;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
            border-radius: 8px;
        }

        .sidebar a:hover {
            background-color: #2563eb;
            color: white;
        }

        .navbar-top {
            background-color: white;
            padding: 10px 20px;
            border-bottom: 1px solid #e5e7eb;
            margin-left: 240px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .menu-btn {
            font-size: 22px;
            cursor: pointer;
            display: none;
            color: #111;
        }

        @media (max-width: 992px) {
            .navbar-top {
                margin-left: 0;
            }

            .sidebar {
                left: -240px;
            }

            .sidebar.active {
                left: 0;
            }

            .menu-btn {
                display: block;
            }
        }
    </style>
</head>

<body>

    <nav>
        <div class="sidebar" id="sidebar">
            <h4 class="text-center fw-bold mb-4"><i class="fa fa-line-chart text-success"></i> TabunganKu</h4>
            @if (Auth::check() && Auth::user()->role == 'admin')
                <a class="nav-link" href="{{ route('home') }}"><i class="fa-solid fa-house"></i>
                    <span class="ms-1 fw-semibold">Home</span></a>
                <a class="nav-link" href="#"><i class="fa-solid fa-film"></i>
                    <span class="ms-1 fw-semibold">Cinemas</span></a>
                <a class="nav-link" href="#"><i class="fa-solid fa-ticket"></i>
                    <span class="ms-1 fw-semibold">Ticket</span></a>
            @elseif (Auth::check() && Auth::user()->role == 'user')
                <a href=""><i class="fa-solid fa-house"></i> Beranda</a>
                <a href="{{ route('user.targets.create') }}"><i class="fa-solid fa-plus"></i> Input Target Baru</a>
                <a href="{{ route('user.riwayats.index') }}"><i class="fa-solid fa-clock-rotate-left"></i> Riwayat</a>
            @else
                <a href=""><i class="fa-solid fa-house"></i> Beranda</a>
                <a href=""><i class="fa-solid fa-plus"></i> Input Target Baru</a>
                <a href=""><i class="fa-solid fa-clock-rotate-left"></i> Riwayat</a>
            @endif
        </div>

        <div class="navbar-top">
            <div class="d-flex align-items-center">
                <span class="menu-btn me-3" id="menu-btn"><i class="fa fa-bars"></i></span>
                <span class="fw-bold text-dark">
                    @auth
                        {{ Auth::user()->name }}
                    @else
                        <i class="fa fa-line-chart text-success"></i>
                    @endauth
                </span>
            </div>

            <div class="navbar-nav d-flex align-items-center">
                @auth
                    <a href="{{ route('logout') }}" class="btn btn-danger rounded-3 ms-3">Logout</a>
                @endauth

                @guest
                    <div class="d-flex align-items-center">
                        <a href="{{ route('login') }}" class="btn btn-link px-3 me-2 text-dark">Login</a>
                        <a href="{{ route('signup') }}" class="btn btn-primary rounded-3">Sign Up</a>
                    </div>
                @endguest
            </div>
        </div>
    </nav>

    <div>
        @yield('navbar')
    </div>

    <script>
        const menuBtn = document.getElementById('menu-btn');
        const sidebar = document.getElementById('sidebar');

        menuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    </script>

</body>

</html>
