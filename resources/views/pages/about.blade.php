@extends('components.layouts.base')

@section('title', 'About Us')

@section('content')

<section>
    <!-- Hero Section -->
    <div class="hero-section"
        style="background-color:rgba(138, 47, 39, 0.95); color: #ffffff; padding: 100px 0 40px; text-align: center; background: linear-gradient(to right, rgba(138, 47, 39, 0.9), rgba(33, 18, 12, 0.9)), url('{{ asset('image/bg-1.jpg') }}') center/cover no-repeat;">
        <h1><span style="color: #f8a42f; font-size: 3rem; font-weight: bold;">ABOUT</span> US</h1>
        <nav class="breadcrumb" style="background: none; justify-content: center; margin-top: 10px;">
            <a class="breadcrumb-item text-light text-decoration-none" href="{{ url('/') }}">Home</a>
            <a class="breadcrumb-item active text-decoration-none text-light" href="#">About Us</a>
        </nav>
    </div>

    <!-- Our Story Section -->
    <div class="story-section text-dark" style="background-color: #ffffff; padding: 40px 20px;">
        <div class="container">
            <div class="mb-5">
                <h2 class="fw-bold fs-1 mt-4" style="color: rgb(171, 181, 185); font-family: 'Lucida Console';">
                    ABOUT US
                </h2>
                <div class="mt-4" style="height: 10px; width: 80px; background-color: #a83429;"></div>
            </div>

            <div class="row gy-4">
                <div class="col-md-6">
                    <p>Berlokasi di sebuah gang sempit di Tegal, kedai kopi kami hadir dengan konsep hangat dan
                        sederhana. Menyajikan kopi asli Nusantara, dessert lezat, hingga makanan rumahan yang siap
                        menemani waktu santaimu.</p>
                    <p>Kami percaya bahwa biji kopi terbaik datang dari para petani lokal. Dengan bekerja sama langsung
                        bersama petani dan roaster, kami menghadirkan cita rasa otentik kopi Indonesia di setiap
                        cangkirnya, dari Arabica grade satu hingga racikan manual brew tradisional.</p>
                    <p>Tempat kami bukan sekadar cafe, tetapi menjadi ruang cerita dan temu warga sekitar, menciptakan
                        suasana akrab dan bersahabat. Kami selalu terbuka untuk siapa saja yang ingin berbagi cerita — di gang kecil ini, kamu akan menemukan rasa pulang.</p>
                </div>

                <!-- Image & Opening Hours Section -->
                <div class="col-md-6">
                    @if($aboutImages->get(0))
                        <img src="{{ asset('storage/' . $aboutImages->get(0)->image_path) }}" alt="Coffee Shop"
                            class="img-fluid mb-4 rounded" style="max-width: 100%; height: auto; max-height: 250px;" />
                    @endif

                    <div class="row">
                        <div class="col-5">
                            @if($aboutImages->get(1))
                                <img src="{{ asset('storage/' . $aboutImages->get(1)->image_path) }}" alt="Barista at Work"
                                    class="img-fluid rounded" style="max-width: 100%; height: auto; max-height: 220px;" />
                            @endif
                        </div>
                        <div class="col-7">
                            <div class="box-white" style="height: 100%; padding: 15px; font-size: 0.9rem;">
                                <strong>OPENING HOURS</strong><br />
                                16:00 - 00:00 | Open Daily
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<!-- Facility Section -->
<section>
    @include('components.facility')
</section>

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endpush

@endsection