@extends('components.layouts.base')

@section('title', 'Menu')

@section('content')
<section>
    <!-- Hero Section -->
    <div class="hero-section"
        style="background-color:rgba(138, 47, 39, 0.95); color: #ffffff; padding: 100px 0 40px; text-align: center; background: linear-gradient(to right, rgba(138, 47, 39, 0.9), rgba(33, 18, 12, 0.9)), url('{{ asset('image/bg-1.jpg') }}') center/cover no-repeat;"
        data-aos="zoom-in">
        <h1><span style="color: #f8a42f; font-size: 3rem; font-weight: bold;">OUR</span> MENU</h1>
        <nav class="breadcrumb" style="background: none; justify-content: center; margin-top: 10px;">
            <a class="breadcrumb-item text-light text-decoration-none" href="{{ url('/') }}">Home</a>
            <a class="breadcrumb-item active text-decoration-none text-light" href="#">Menu</a>
        </nav>
    </div>

    <!-- Product Filter & List Section -->
    <div class="story-section text-dark" style="background-color: #ffffff; padding: 40px 20px;" id="menuTabsSection">
        <div class="container">
            <div class="mb-5 text-center" data-aos="fade-down">
                <h2 class="fw-bold fs-1 mt-4" style="color: rgb(171, 181, 185); font-family: 'Lucida Console';">
                    MENU KAMI
                </h2>
                <div class="mt-4 mx-auto" style="height: 10px; width: 80px; background-color: #a83429;"></div>
            </div>

            <!-- Tabs -->
            <ul class="nav nav-pills justify-content-center mb-4" id="categoryTabs" data-aos="fade-up">
                <li class="nav-item">
                    <button type="button" class="nav-link active" data-category="all">All</button>
                </li>
                @foreach($categories as $category)
                    <li class="nav-item">
                        <button type="button" class="nav-link"
                            data-category="{{ $category->slug }}">{{ $category->name }}</button>
                    </li>
                @endforeach
            </ul>

            <!-- Product Grid -->
            <div id="productContainer" data-aos="fade-up" data-aos-delay="200">
                @include('web.products', ['products' => $products])
            </div>
        </div>
    </div>
</section>

<!-- Facility Section -->
<section data-aos="fade-up">
    @include('components.facility')
</section>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
<style>
    #categoryTabs .nav-link {
        color: #a83429 !important;
        border: 1px solid transparent;
    }

    #categoryTabs .nav-link.active {
        background-color: #a83429 !important;
        color: white !important;
    }
</style>


@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1200,
        once: true,
        easing: 'ease-in-out'
    });

    document.addEventListener("DOMContentLoaded", function () {
        const container = document.getElementById('productContainer');
        const buttons = document.querySelectorAll('#categoryTabs .nav-link');

        function scrollToElementById(id) {
            const el = document.getElementById(id);
            if (el) {
                const yOffset = -80;
                const y = el.getBoundingClientRect().top + window.pageYOffset + yOffset;
                window.scrollTo({ top: y, behavior: 'smooth' });
            }
        }

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                buttons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                const slug = this.getAttribute('data-category');

                if (slug === 'all') {
                    fetch("{{ route('menu') }}")
                        .then(res => res.text())
                        .then(html => {
                            const temp = document.createElement('div');
                            temp.innerHTML = html;
                            const newContent = temp.querySelector('#productContainer').innerHTML;
                            container.innerHTML = newContent;

                            AOS.refresh(); // biar animasi muncul lagi
                            scrollToElementById('menuTabsSection');
                        });
                } else {
                    fetch(`/menu/category/${slug}`)
                        .then(res => res.json())
                        .then(data => {
                            container.innerHTML = data.products;

                            AOS.refresh();
                            setTimeout(() => {
                                scrollToElementById(`category-${slug}`);
                            }, 100);
                        })
                        .catch(err => {
                            console.error('Fetch error:', err);
                            container.innerHTML = '<p class="text-center text-danger">Gagal memuat produk.</p>';
                        });
                }
            });
        });
    });
</script>
@endpush
@endsection
