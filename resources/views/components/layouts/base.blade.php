<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home')</title>

    <!-- Stylesheets -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}">

    <!-- Fonts & Icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Page Transition Styles -->
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        body.fade-out {
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        body.fade-in {
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
        }
    </style>
</head>

<body class="fade-out" style="background-color:#fffff; color: #f4f1ee;">

    <div class="wrapper">
        <!-- Navbar -->
        <header>
            @include('components.navbar')
        </header>

        <!-- Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="pt-5">
            @include('components.footer')
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script>
        // Inisialisasi DataTable
        $(document).ready(function () {
            $('#myTable').DataTable();
        });

        // Scroll navbar efek
        window.addEventListener('scroll', function () {
            const navbar = document.querySelector('.custom-navbar');
            if (window.scrollY > 70) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Transisi antar halaman
        document.addEventListener("DOMContentLoaded", function () {
            // Jalankan fade-in saat halaman siap
            document.body.classList.remove('fade-out');
            document.body.classList.add('fade-in');

            // Efek fade saat klik link (tanpa spinner)
            document.querySelectorAll("a").forEach(function (el) {
                const href = el.getAttribute("href");

                if (href && !href.startsWith("#") && !href.startsWith("http") && !el.hasAttribute("target")) {
                    el.addEventListener("click", function (e) {
                        e.preventDefault();

                        // Jalankan efek fade-out
                        document.body.classList.remove("fade-in");
                        document.body.classList.add("fade-out");

                        // Redirect setelah animasi selesai
                        setTimeout(function () {
                            window.location.href = href;
                        }, 500);
                    });
                }
            });
        });
    </script>
    @stack('scripts')
</body>

</html>