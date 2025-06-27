<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

@if($carouselImages->count())
    <div id="carouselExample" class="carousel slide position-relative" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">
            @foreach ($carouselImages as $key => $item)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img src="{{ asset('storage/' . $item->image_path) }}" class="d-block"
                        style="width: 100%; height: 1000px; object-fit: cover; object-position: center;" alt="Carousel Image">
                    
                    <!-- Overlay gelap -->
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.6);">
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Overlay Konten -->
    <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100">
        <div class="bg-opacity-10 p-4 rounded text-white text-center">
            <div class="mb-3">
                <img src="{{ asset('image/logo.jpg') }}" class="rounded-circle" width="150" alt="Logo">
            </div>
            <h1 class="fw-bold">Welcome to</h1>
            <p class="fs-5 mb-1">Irish Coffee & Bakehouse Tegal</p>
            <h5 class="fw-bold">Tempat Nongkrong Rasa Rumah</h5>
            <p class="small">Dapatkan pengalaman berbeda melalui kopi terbaik dan penawaran eksklusif untuk pelanggan
                setia.</p>
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
@else
    <p class="text-center my-5 text-muted">Tidak ada gambar aktif untuk ditampilkan di carousel.</p>
@endif

<style>
    /* Efek zoom+rotate untuk gambar carousel */
    .carousel-item img {
        transform: scale(1.1) rotate(-1deg);
        opacity: 0.7;
        transition: all 1.2s ease-in-out;
    }

    .carousel-item.active img {
        transform: scale(1) rotate(0deg);
        opacity: 1;
    }

    /* Teks animasi masuk satu per satu */
    .carousel-caption h1,
    .carousel-caption p,
    .carousel-caption h5 {
        opacity: 0;
        transform: translateY(30px);
        animation: slideFadeIn 1s ease forwards;
    }

    .carousel-caption h1 { animation-delay: 0.5s; }
    .carousel-caption p { animation-delay: 1s; }
    .carousel-caption h5 { animation-delay: 1.5s; }

    @keyframes slideFadeIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Efek glow hover untuk logo */
    .carousel-caption img:hover {
        box-shadow: 0 0 25px rgba(255, 255, 255, 0.8);
        transform: scale(1.1) rotate(1deg);
        transition: all 0.4s ease-in-out;
    }

    .carousel-caption > div {
        padding: 20px;
        border-radius: 12px;
    }
</style>
