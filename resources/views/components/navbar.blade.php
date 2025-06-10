<nav class="navbar navbar-expand-lg custom-navbar">
  <div class="container-fluid">
    <!-- Brand di kiri -->
    <a class="navbar-brand fw-bold ms-3" style="color: #d4af37;" href="{{ url('/') }}">
      <div class="brand fw-bold" style="font-size: 24px; font-family: 'Cinzel', serif;">IRISH</div>
      <div class="tagline" style="font-size: 14px; font-family: 'Cinzel', serif;">Coffee & Bakes</div>
    </a>

    <!-- Toggler untuk mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Isi navbar -->
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
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
      </ul>
    </div>

    <!-- Login icon di kanan -->
    <div class="d-flex align-items-center me-3">
      <a href="{{ route('login') }}" class="nav-link">
        <i class="fas fa-user" style="color: #cccccc; font-size: 20px;"></i>
      </a>
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
    background-color: rgba(138, 47, 39, 0.95); /* warna saat scroll */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(10px);
  }

  /* Gaya agar link navbar tetap terlihat */
  .custom-navbar .nav-link {
    color: #ccc !important;
    transition: color 0.3s ease;
  }

  .custom-navbar .nav-link.active {
    color: #fff !important;
    font-weight: bold;
  }

</style>
<!-- Tambahkan Font Awesome jika belum -->
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

@endpush


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