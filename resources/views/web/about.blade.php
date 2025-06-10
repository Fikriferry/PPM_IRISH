@extends('components.layouts.base')

@section('title', 'About Us')

@section('content')

<section>
    <!-- Hero Section -->
    <div class="hero-section"
        style="background-color:rgba(138, 47, 39, 0.95); color: #ffffff; padding: 100px 0 40px; text-align: center;">
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
                    OUR STORY
                </h2>
                <div class="mt-4" style="height: 10px; width: 80px; background-color: #a83429;"></div>
            </div>

            <div class="row gy-4">
                <div class="col-md-6">
                    <p>Coffee shop yang nyaman dan kekinian di Tegal, menghadirkan beragam dessert lezat, hidangan nasi
                        hangat, dan kopi berkualitas untuk menemani waktu santaimu. Kami buka setiap hari mulai sore
                        hingga tengah malam, siap jadi tempat andalanmu untuk bersantai maupun merayakan momen spesial.
                    </p>
                    <p>We know, and so do you, that the world's best coffee beans come from Indonesia. We travel to
                        various corners of Indonesia and work with local coffee farmers and roasters to get the best
                        taste of Indonesian coffee, grade one Arabica beans and various plantations spread across the
                        archipelago.</p>
                    <p>With our experience and knowledge in the retail coffee industry, from coffee bean processing to
                        how to design a coffee bar, we make your coffee business journey EASY, SIMPLE, and FUN!</p>
                </div>

                <!-- Image & Opening Hours Section -->
                <div class="col-md-6">
                    <!-- Main image -->
                    <img src="{{ asset('image/about-1.jpg') }}" alt="Coffee Shop"
                        class="img-fluid mb-4 rounded" style="max-width: 100%; height: auto; max-height: 250px;" />

                    <div class="row">
                        <div class="col-5">
                            <img src="{{ asset('image/about-2.jpg') }}" alt="Barista at Work"
                                class="img-fluid rounded" style="max-width: 100%; height: auto; max-height: 220px;" />
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
