<div class="container py-5">
    <div class="text-center mb-5">
        <p class="fw-semibold mb-3" style="font-family: Helvetica; color: #a83429;">FROM THE BEST TEGAL SPECIALTY COFFEE
            TO HEART-WARMING FOODS</p>
        <h2 class="fw-bold fs-1 mt-4" style="color: rgb(171, 181, 185); font-family: 'Lucida Console';">CATEGORY MENU</h2>
        <div class="mx-auto mt-4" style="height: 8px; width: 80px; background-color: #a83429;"></div>
    </div>

    <div id="menuCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($categories->chunk(4) as $chunkIndex => $chunk)
                <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                    <div class="row text-center g-4">
                        @foreach($chunk as $category)
                            <div class="col-md-3">
                                <a href="{{ route('menu', $category->slug) }}" class="text-decoration-none">
                                    <div class="menu-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                        <img src="{{ asset('storage/' . $category->image) }}" class="img-fluid rounded"
                                            alt="{{ $category->name }}">
                                        <h5 class="mt-3" style="color:#1a1a1a;">{{ $category->name }}</h5>
                                        <p class="small" style="color: #676767;">
                                            {{ $category->description }}
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @endforeach


                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#menuCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#menuCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<style>
    .menu-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(171, 52, 41, 0.2);
        transition: all 0.3s ease;
    }

    .menu-card img {
        transition: transform 0.3s ease;
    }

    .menu-card:hover img {
        transform: scale(1.05);
    }

    .menu-card h5 {
        transition: color 0.3s ease;
    }

    .menu-card:hover h5 {
        color: #d4af37;
    }
</style>