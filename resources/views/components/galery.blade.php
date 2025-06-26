<section class="bg-white px-3 text-center">
    <!-- Judul -->
    <div class="container py-5 mt-4">
    <div class="text-center mb-5">
        <p class="fw-semibold mb-3" style="font-family: Helvetica; color: #a83429;">FROM BEANS TO SMILES — OUR JOURNEY IN PICTURES</p>
        <h2 class="fw-bold fs-1 mt-4" style="color: rgb(171, 181, 185); font-family: 'Lucida Console';">GALLERY</h2>
        <div class="mx-auto mt-4" style="height: 8px; width: 80px; background-color: #a83429;"></div>
    </div>

    <!-- Galeri -->
    <div class="container">
        <div class="row justify-content-center g-5">
            @foreach ([
                'carousel-2.jpg',
                'glr-1.jpg',
                'glr-2.jpg',
                'glr-3.jpg',
                'glr-4.jpg',
                'glr-5.jpg',
                'glr-6.jpg',
                'glr-7.jpg',
                'glr-8.jpg',
                'glr-9.jpg',
                'glr-10.jpg',
                'glr-11.jpg',
            ] as $img)
                <div class="col-6 col-sm-4 col-md-2">
                    <div class="ratio ratio-1x1 mx-auto overflow-hidden hover-zoom" style="max-width: 150px;">
                        <img src="{{ asset('image/' . $img) }}" alt="Galeri"
                             class="w-100 h-100 grayscale-img hover-gray gallery-img"
                             data-img="{{ asset('image/' . $img) }}">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Modal Viewer -->
<div id="imageModal" class="image-modal" onclick="closeModal()">
    <img id="modalImage" src="">
</div>

<!-- Style -->
<style>
    .grayscale-img {
        object-fit: cover;
        filter: grayscale(100%);
        transition: filter 0.3s ease, transform 0.3s ease;
    }

    .hover-gray:hover {
        filter: grayscale(0%);
    }

    .hover-zoom:hover {
        transform: scale(1.1);
        transition: transform 0.3s ease;
    }

    .image-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0; top: 0;
        width: 100vw; height: 100vh;
        background-color: rgba(0, 0, 0, 0.8);
        justify-content: center;
        align-items: center;
        cursor: zoom-out;
    }

    .image-modal img {
        max-width: 90%;
        max-height: 90%;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
    }
</style>

<!-- Script -->
<script>
    document.querySelectorAll('.gallery-img').forEach(img => {
        img.addEventListener('click', function () {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            modalImg.src = this.dataset.img;
            modal.style.display = 'flex';
        });
    });

    // Tutup modal jika diklik
    function closeModal() {
        document.getElementById('imageModal').style.display = 'none';
    }
</script>