@extends('components.layouts.base')

@section('title', 'Kontak Kami')

@section('content')

<section>
    <!-- Hero Section -->
    <div class="hero-section"
        style="background-color:rgba(138, 47, 39, 0.95); color: #ffffff; padding: 100px 0 40px; text-align: center; background: linear-gradient(to right, rgba(138, 47, 39, 0.9), rgba(33, 18, 12, 0.9)), url('{{ asset('image/bg-1.jpg') }}') center/cover no-repeat;">
        <h1><span style="color: #f8a42f; font-size: 3rem; font-weight: bold;">CONTACT</span> US</h1>
        <nav class="breadcrumb" style="background: none; justify-content: center; margin-top: 10px;">
            <a class="breadcrumb-item text-light text-decoration-none" href="{{ url('/') }}">Home</a>
            <a class="breadcrumb-item active text-decoration-none text-light" href="#">Contact</a>
        </nav>
    </div>

    <!-- Konten Kontak -->
    <div class="story-section text-dark" style="background-color: #ffffff; padding: 40px 20px;">
        <div class="container">
            <div class="mb-5">
                <h2 class="fw-bold fs-1 mt-4" style="color: rgb(171, 181, 185); font-family: 'Lucida Console';">
                    CONTACT US
                </h2>
                <div class="mt-4" style="height: 10px; width: 80px; background-color: #a83429;"></div>
            </div>

            <div class="row gy-4">
                <div class="col-md-6">
                    <img src="{{ asset('image/carousel-2.jpg') }}" alt="Barista"
                        class="img-fluid rounded mb-4" style="max-width: 100%; height: auto; max-height: 250px;" />
                    <h5 class="fw-bold mt-2">SEJAK 2006</h5>
                    <p class="text-muted" style="font-size: 0.95rem;">
                        <em>"Karna tempat pulang bukan hanya 'rumah' bisa jadi tempat pulangmu adalah irish bakehouse"</em>
                    </p>
                </div>

                <div class="col-md-6">
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3"><i class="fas fa-map-marker-alt text-danger me-2"></i>IRISH Coffe</h6>
                        <p><strong>TEGAL</strong><br>
                            Jl. Cendrawasih No.97, Randugunting, Kec. Tegal Sel., Kota Tegal, Jawa Tengah 52131<br>
                            Telp. (+62) 895-3773-27233
                        </p>
                    </div>

                    <div>
                        <h6 class="fw-bold mb-2"><i class="fas fa-store text-danger me-2"></i>STORES</h6>
                        <p class="text-muted" style="font-size: 0.95rem;">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.105827313787!2d109.13213827592119!3d-6.877923067300497!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fb9b126f32d83%3A0x164e246709788d1c!2sIrish%20Koff%20(Coffee%20%26%20Bakehouse)!5e0!3m2!1sid!2sid!4v1750914132644!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </p>
                        <p class="text-dark fw-medium">
                            Tegal
                        </p>
                    </div>
                </div>
            </div>

            <!-- Jejaring Media -->
            <div class="text-center mt-5">
                <h5 class="fw-bold">JEJARING KONTAK</h5>
                <p class="text-muted">Anda dapat berkomunikasi lebih jauh dengan kami melalui jejaring media berikut:</p>
                <div class="row justify-content-center g-4">
                    <div class="col-6 col-md-3">
                        <i class="fab fa-instagram fa-2x text-danger"></i>
                        <p class="mt-2 mb-1">INSTAGRAM</p>
                        <small class="text-danger">@irish.koff</small>
                    </div>
                    <div class="col-6 col-md-3">
                        <i class="fas fa-envelope fa-2x text-danger"></i>
                        <p class="mt-2 mb-1">EMAIL</p>
                        <small class="text-danger">IrishCoffe@gmail.com</small>
                    </div>
                    <div class="col-6 col-md-3">
                        <i class="fab fa-whatsapp fa-2x text-danger"></i>
                        <p class="mt-2 mb-1">WHATSAPP</p>
                        <small class="text-danger">895377327233</small>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endpush