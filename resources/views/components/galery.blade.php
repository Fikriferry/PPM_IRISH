<section class="bg-white px-3 text-center">
    <!-- Judul -->
    <div class="container py-5 mt-4">
        <div class="text-center mb-5" data-aos="fade-up">
            <p class="fw-semibold mb-3" style="font-family: Helvetica; color: #a83429;">
                FROM BEANS TO SMILES — OUR JOURNEY IN PICTURES
            </p>
            <h2 class="fw-bold fs-1 mt-4" style="color: rgb(171, 181, 185); font-family: 'Lucida Console';">
                GALLERY
            </h2>
            <div class="mx-auto mt-4" style="height: 8px; width: 80px; background-color: #a83429;"></div>
        </div>

        <!-- Galeri -->
        <div class="container">
            <div class="row justify-content-center g-5">
                @foreach ($galleryImages as $index => $item)
                    <div class="col-6 col-sm-4 col-md-2" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="ratio ratio-1x1 mx-auto overflow-hidden hover-zoom" style="max-width: 150px;">
                            <img src="{{ asset('storage/' . $item->image_path) }}" alt="Galeri"
                                class="w-100 h-100 grayscale-img hover-gray gallery-img"
                                data-img="{{ asset('storage/' . $item->image_path) }}">
                        </div>
                    </div>
                @endforeach
            </div>
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
        left: 0;
        top: 0;
        width: 100vw;
        height: 100vh;
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

<!-- Script AOS & Modal -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({
        once: true,
        duration: 700
    });

    // Modal klik gambar
    document.querySelectorAll('.gallery-img').forEach(img => {
        img.addEventListener('click', function () {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            modalImg.src = this.dataset.img;
            modal.style.display = 'flex';
        });
    });

    function closeModal() {
        document.getElementById('imageModal').style.display = 'none';
    }
</script>