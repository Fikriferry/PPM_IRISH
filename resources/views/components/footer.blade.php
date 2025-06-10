<!-- Footer -->
<div class="bg-dark text-white"
    style="background: linear-gradient(to right, rgba(138, 47, 39, 0.9), rgba(33, 18, 12, 0.9)), url('{{ asset('image/bg-footer.jpg') }}') center/cover no-repeat;">
    <div class="container text-center" style="padding: 50px 0;">
        <div class="mb-3">
            <!-- Logo dan Nama Brand -->
            <img src="{{ asset('image/tr-logo.png') }}" alt="Logo" height="60" class="mb-2">
            <h4 class="d-inline-block fw-bold mb-0 me-2">Irish Coffee & Dessert Tegal</h4>
            <h3 class="d-inline-block mb-0"> | </h3>

            <!-- Icon Sosial Media -->
            <span class="ms-3 fs-4">
                <i class="bi bi-tiktok me-2"></i>
                <i class="bi bi-instagram"></i>
            </span>
        </div>

        <!-- Navigasi -->
        <div class="mb-3">
            <a href="{{ url('/') }}" class="text-white text-decoration-none mx-2">Home</a> |
            <a href="{{ url('/product') }}" class="text-white text-decoration-none mx-2">Menu</a> |
            <a href="{{ url('/about') }}" class="text-white text-decoration-none mx-2">About Us</a> |
            <a href="{{ url('/contact') }}" class="text-white text-decoration-none mx-2">Contact</a>
        </div>

        <!-- Deskripsi -->
        <div class="small mb-3" style="color: rgb(214, 214, 214);">
            <p class="mb-0">
                Coffee shop yang nyaman dan kekinian di Tegal, menyajikan dessert lezat, hidangan hangat, dan kopi
                berkualitas untuk menemani waktumu.
            </p>
            <p class="mb-0">
                Kami bekerja sama dengan petani lokal di berbagai pelosok Indonesia untuk menghadirkan kopi Arabika
                grade satu terbaik dari Nusantara.
            </p>
        </div>
    </div>
</div>

<!-- Footer bawah -->
<div class="text-dark py-2" style="background-color: #f0ddc9; text-align: center;">
    <small>© 2025 Pengabdian Masyarakat | Powered by 4C</small>
</div>
