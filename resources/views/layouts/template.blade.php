<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Movie Db - @yield('title', 'Homepage')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- jQuery (required for AJAX and Bootstrap 4) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        body {
            padding-bottom: 80px;
            /* untuk footer */
        }

        /* Tambahan style untuk dropdown menu */
        .dropdown-item a {
            text-decoration: none;
            color: #212529;
            display: block;
            padding: 0.25rem 1rem;
        }

        /* Style untuk dropdown toggle */
        .nav-item .dropdown-toggle {
            color: rgba(255, 255, 255, 0.75);
            padding: 0.5rem 1rem;
        }

        .nav-item .dropdown-toggle:hover {
            color: white;
        }

        .nav-item .dropdown-toggle::after {
            margin-left: 0.5em;
        }

        .login:hover {
            color: white;
        }
    </style>
</head>

<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">Movie DB</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('movies.index') }}">Home</a>
                    </li>
                </ul>

                <ul class="navbar-nav me-3">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="/movie/create">Input Movie</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket"></i>
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link login active btn btn-outline-success btn-sm" href="/login">Login</a>
                        </li>

                    @endauth
                </ul>
                @if (request()->routeIs('movies.index'))
                    <form class="d-flex" action="{{ route('movies.index') }}" method="GET">
                        <input class="form-control me-2" type="search" name="search" placeholder="Search"
                            aria-label="Search" value="{{ request('search') }}">
                        <button class="btn btn-outline-light" type="submit">Search</button>
                    </form>
                @endif
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="py-4">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-success text-white text-center py-2 fixed-bottom">
        <div class="container">
            <small>Copyright &copy; {{ date('Y') }} by Fadhil</small>
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

