<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div id="carouselExample" class="carousel slide position-relative" data-bs-ride="carousel" data-bs-interval="3000">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('image/carousel-1.jpg') }}" class="d-block w-100" alt="Slide 1">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('image/carousel-2.jpg') }}" class="d-block w-100" alt="Slide 2">
        </div>
    </div>

    <!-- Overlay Konten -->
    <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100">
        <div class=" bg-opacity-10 p-4 rounded text-white text-center">
            <div class="mb-3">
                <img src="{{ asset('image/logo.jpg') }}" class="rounded-circle" width="150" alt="Logo">
            </div>
            <h1 class="fw-bold">Selamat Datang di</h1>
            <p class="fs-5 mb-1">Irish Coffee & Bakehouse Tegal</p>
            <h5 class="fw-bold">Lorem ipsum</h5>
            <p class="small">Dapatkan diskon khusus, free kopi, dan special event khusus member.</p>
        </div>
    </div>

    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

@push('styles')
<style>
    .carousel-caption {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 10;
        padding: 0 15px;
    }

    @media (max-width: 500px) {
        .carousel-caption img {
            width: 100px;
        }
        .carousel-caption h1 {
            font-size: 1.8rem;
        }
        .carousel-caption .fs-5 {
            font-size: 1rem;
        }
    }

    
</style>
@endpush
