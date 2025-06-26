<nav class="navbar navbar-expand-lg custom-navbar">
  <div class="container-fluid">
    <!-- Brand -->
    <a class="navbar-brand fw-bold ms-3" style="color: #d4af37;" href="{{ url('/') }}">
      <div class="brand fw-bold" style="font-size: 24px; font-family: 'Cinzel', serif;">IRISH</div>
      <div class="tagline" style="font-size: 14px; font-family: 'Cinzel', serif;">Coffee & Bakes</div>
    </a>

    <!-- Toggler untuk mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#loginNavbar"
      aria-controls="loginNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Isi navbar login -->
    <div class="collapse navbar-collapse" id="loginNavbar">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-3">
        <li class="nav-item mx-2">
          <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
        </li>

        @if (Request::is('customer/register'))
      <li class="nav-item mx-2">
        <a class="nav-link {{ Request::is('customer/login') ? 'active' : '' }}"
        href="{{ route('customer.login') }}">Login</a>
      </li>
    @else
      <li class="nav-item mx-2">
        <a class="nav-link {{ Request::is('customer/register') ? 'active' : '' }}"
        href="{{ route('customer.register') }}">Register</a>
      </li>
    @endif
      </ul>

    </div>
  </div>
</nav>

<style>
  .custom-navbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    width: 100%;
    z-index: 9999;
    background-color: transparent;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
  }

  .custom-navbar.scrolled {
    background-color: rgba(138, 47, 39, 0.95); /* warna bata gelap dengan transparansi */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(10px);
  }

  /* Link default */
  .custom-navbar .nav-link {
    color: #cccccc !important;
    transition: color 0.3s ease;
    font-weight: 500;
  }

  /* Hover effect emas */
  .custom-navbar .nav-link:hover {
    color: #d4af37 !important; /* emas */
  }

  /* Link aktif */
  .custom-navbar .nav-link.active {
    color: #ffffff !important;
    font-weight: bold;
  }

  /* Brand hover (opsional) */
  .navbar-brand:hover {
    color: #f5d06f !important;
  }

  .navbar-toggler {
    border-color: #d4af37;
  }

  .navbar-toggler-icon {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%28%20212,%20175,%2055,%201%20%29)' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
  }
</style>


@push('scripts')
  <script>
    window.addEventListener('scroll', function () {
    const navbar = document.querySelector('.custom-navbar');
    if (window.scrollY > 70) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
    });
  </script>
@endpush