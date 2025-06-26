<nav class="navbar navbar-expand-lg custom-navbar">
  <div class="container-fluid">
    <!-- Brand di kiri -->
    <a class="navbar-brand fw-bold ms-3" style="color: #d4af37;" href="{{ url('/') }}">
      <div class="brand fw-bold" style="font-size: 24px; font-family: 'Cinzel', serif;">IRISH</div>
      <div class="tagline" style="font-size: 14px; font-family: 'Cinzel', serif;">Coffee & Bakes</div>
    </a>

    <!-- Toggler untuk mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
      aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Isi Navbar -->
    <div class="collapse navbar-collapse" id="mainNavbar">
      <!-- Menu navigasi di tengah -->
      <ul class="navbar-nav mx-auto mb-3 mb-lg-0">
        <li class="nav-item mx-3">
          <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item mx-3">
          <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="{{ url('/about') }}">About</a>
        </li>
        <li class="nav-item mx-3">
          <a class="nav-link {{ Request::is('menu') ? 'active' : '' }}" href="{{ url('/menu') }}">Menu</a>
        </li>
        <li class="nav-item mx-3">
          <a class="nav-link {{ Request::is('contact') ? 'active' : '' }}" href="{{ url('/contact') }}">Contact</a>
        </li>

        @auth('customer')
        <li class="nav-item dropdown mx-3">
          <a class="nav-link dropdown-toggle {{ Request::is('products') || Request::is('categories') || Request::is('orders') ? 'active' : '' }}"
            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Manage
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/products">Product</a></li>
            <li><a class="dropdown-item" href="/categories">Category</a></li>
            <li><a class="dropdown-item" href="/orders">Orders</a></li>
          </ul>
        </li>
        @endauth
      </ul>

      <!-- Bagian kanan (login / nama user) -->
      <div class="d-flex align-items-center me-3">
        @auth('customer')
        <div class="dropdown">
          <a class="btn btn-outline-light dropdown-toggle" href="#" role="button" id="userDropdown"
            data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::guard('customer')->user()->name }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li>
              <form method="POST" action="{{ route('customer.logout') }}">
                @csrf
                <button class="dropdown-item" type="submit">Logout</button>
              </form>
            </li>
          </ul>
        </div>
        @else
        <a href="{{ route('customer.login') }}" class="nav-link">
          <i class="fas fa-user" style="color: #cccccc; font-size: 20px;"></i>
        </a>
        @endauth
      </div>
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
    background-color: rgba(138, 47, 39, 0.95);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(10px);
  }

  .custom-navbar .nav-link {
    color: #ccc !important;
    transition: color 0.3s ease;
  }

  .custom-navbar .nav-link.active {
    color: #fff !important;
    font-weight: bold;
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
