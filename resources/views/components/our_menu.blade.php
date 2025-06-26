<div class="container py-5">
    <!-- Title -->
    <div class="text-center mb-5">
        <h1>  </h1>
        <p class="fw-semibold mb-3" style="font-family: Helvetica; color: #a83429;">
            FROM THE BEST INDONESIAN SPECIALTY COFFEE TO HEART-WARMING FOODS
        </p>
        <h2 class="fw-bold fs-1 mt-4" style="color: rgb(171, 181, 185); font-family: 'Lucida Console';">
            OUR MENU
        </h2>
        <div class="mx-auto mt-4" style="height: 8px; width: 80px; background-color: #a83429;"></div>
    </div>

    <!-- Menu Grid -->
    <div class="row text-center g-4">
        <!-- COFFE & NON-COFFE -->
        <div class="col-md-3 menu-card">
            <img src="{{ asset('image/menu-1.jpg') }}" class="img-fluid rounded" alt="Our Beans">
            <h5 class="mt-3" style="color:#1a1a1a;">COFFE & NON-COFFE</h5>
            <p class="small" style="color: #676767;">
                Biji kopi grade Specialty Arabica dan Fine Robusta dari 9 perkebunan terbaik Indonesia.
            </p>
        </div>

        <!-- TEA & MOJITO SERIES -->
        <div class="col-md-3 menu-card">
            <img src="{{ asset('image/menu-2.jpg') }}" class="img-fluid rounded" alt="Coffee-Based Drinks">
            <h5 class="mt-3" style="color:#1a1a1a;">TEA & MOJITO SERIES</h5>
            <p class="small" style="color: #676767;">
                Dari minuman tradisional berbasis espresso sampai berbagai minuman racikan kopi terkini.
            </p>
        </div>

        <!-- RICE -->
        <div class="col-md-3 menu-card">
            <img src="{{ asset('image/menu-3.jpg') }}" class="img-fluid rounded" alt="Non-Coffee">
            <h5 class="mt-3" style="color:#1a1a1a;">RICE</h5>
            <p class="small" style="color: #676767;">
                Kami juga memiliki menu non-coffee untuk kamu yang ingin pilihan lain selain kopi dan untuk anak-anak.
            </p>
        </div>

        <!-- DESSERT -->
        <div class="col-md-3 menu-card">
            <img src="{{ asset('image/menu-4.jpg') }}" class="img-fluid rounded" alt="Food & Snack">
            <h5 class="mt-3" style="color:#1a1a1a;">DESSERT</h5>
            <p class="small" style="color: #676767;">
                Berbagai macam makanan ringan sampai makanan utama siap menemani secangkir kopimu.
            </p>
        </div>
    </div>
</div>


<style>
    /* Efek hover untuk card menu */
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
