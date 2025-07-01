@extends('components.layouts.base')

@section('title', 'Create Order')

@section('content')
    <section>
        <div class="hero-section"
        style="background: linear-gradient(to right, rgba(138, 47, 39, 0.9), rgba(33, 18, 12, 0.9)), url('{{ asset('image/bg-1.jpg') }}') center/cover no-repeat; color: #ffffff; padding: 100px 0 40px; text-align: center;">
            <h1><span style="color: #f8a42f; font-size: 3rem; font-weight: bold;">NEW</span> ORDER</h1>
            <nav class="breadcrumb" style="background: none; justify-content: center; margin-top: 10px;">
                <a class="breadcrumb-item text-light text-decoration-none" href="{{ url('/') }}">Home</a>
                <a class="breadcrumb-item text-light text-decoration-none" href="{{ route('orders.index') }}">Orders</a>
                <a class="breadcrumb-item active text-light text-decoration-none" href="#">Create</a>
            </nav>
        </div>

        <div class="container my-5" style="max-width: 850px;">
            <div class="card shadow rounded p-4">
                <h3 class="text-center mb-4" style="color: #a83429;">Order Form</h3>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('orders.store') }}" method="POST" id="orderForm">
                    @csrf

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Pelanggan</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="nomor_meja" class="form-label">Nomor Meja</label>
                        <input type="text" name="nomor_meja" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan Tambahan</label>
                        <textarea name="catatan" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                        <select name="metode_pembayaran" class="form-select" required>
                            <option value="tunai">Tunai</option>
                            <option value="qris">QRIS</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status Pesanan</label>
                        <select name="status" class="form-select" required>
                            <option value="diproses">Diproses</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>

                    <hr>

                    <h5 class="mb-3 text-secondary">Detail Pesanan</h5>
                    <div id="menu-items"></div>
                    <button type="button" id="add-item" class="btn btn-outline-primary mt-3">
                        <i class="fas fa-plus me-1"></i> Tambah Menu
                    </button>

                    <div class="mt-4">
                        <h5 class="text-end">Total Harga: <span id="totalHarga" class="text-dark fw-bold">Rp0</span></h5>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                        <button type="button" id="submitOrder" class="btn btn-dark">
                            <i class="fas fa-save me-2"></i> Simpan Pesanan
                        </button>
                    </div>
                </form>

                <!-- Modal QR Code -->
                <div class="modal fade" id="qrisModal" tabindex="-1" aria-labelledby="qrisModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content p-3">
                            <div class="modal-header">
                                <h5 class="modal-title" id="qrisModalLabel">Pembayaran QRIS</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="{{ asset('image/qris.jpg') }}" alt="QRIS QR Code"
                                    class="img-fluid mb-3" style="max-height: 300px;">
                                <p>Silakan scan QR Code untuk membayar.</p>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-secondary" id="cancelQris">Batal</button>
                                <button type="button" class="btn btn-success" id="confirmQris">Bayar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        .select2-container .select2-results__option {
            color: #000 !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #000 !important;
        }

        .select2-results__options {
            max-height: 250px;
            overflow-y: auto;
        }
    </style>

    <script>
        let index = 0;

        function renderItem(i) {
            return `
                    <div class="row g-3 align-items-center border-bottom pb-3 mb-3 item-row" data-index="${i}">
                        <div class="col-md-4">
                            <label class="form-label">Pilih Menu</label>
                            <select name="items[${i}][product_id]" class="form-select product-select" required style="width: 100%;"></select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Jumlah</label>
                            <input type="number" name="items[${i}][quantity]" class="form-control qty-input" min="1" value="1" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Subtotal</label>
                            <input type="text" class="form-control subtotal-field" readonly value="Rp0">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Catatan</label>
                            <input type="text" name="items[${i}][note]" class="form-control">
                        </div>
                        <div class="col-md-1 mt-4">
                            <button type="button" class="btn btn-sm btn-danger remove-item"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                `;
        }

        function updateSubtotal(row) {
            const select = row.querySelector('.product-select');
            const price = parseFloat(select.getAttribute('data-price') || 0);
            const qty = parseInt(row.querySelector('.qty-input').value || 0);
            const subtotal = price * qty;
            row.querySelector('.subtotal-field').value = isNaN(subtotal) ? 'Rp0' : `Rp${subtotal.toLocaleString()}`;
            updateTotalHarga();
        }


        function updateTotalHarga() {
            let total = 0;
            document.querySelectorAll('.item-row').forEach(row => {
                const select = row.querySelector('.product-select');
                const price = parseFloat(select.getAttribute('data-price') || 0);
                const qty = parseInt(row.querySelector('.qty-input').value || 0);
                total += price * qty;
            });
            document.getElementById('totalHarga').textContent = `Rp${total.toLocaleString()}`;
        }


        function initSelect2(i) {
            const selector = `select[name="items[${i}][product_id]"]`;
            $(selector).select2({
                placeholder: 'Cari menu...',
                width: '100%',
                ajax: {
                    url: '{{ route('api.products.search') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: data.map(item => ({
                                id: item.id,
                                text: `${item.name} - Rp${parseInt(item.price).toLocaleString()}`,
                                price: item.price
                            }))
                        };
                    }
                }
            }).on('select2:select', function (e) {
                const price = e.params.data.price;
                $(this).attr('data-price', price);
                updateSubtotal(this.closest('.item-row'));
            });
        }


        $(document).ready(function () {
            $('#add-item').on('click', function () {
                const container = document.getElementById('menu-items');
                container.insertAdjacentHTML('beforeend', renderItem(index));
                initSelect2(index);
                index++;
            });

            $(document).on('input', '.qty-input', function () {
                updateSubtotal(this.closest('.item-row'));
            });

            $(document).on('click', '.remove-item', function () {
                this.closest('.item-row').remove();
                updateTotalHarga();
            });

            const form = document.getElementById('orderForm');
            const metodeSelect = form.querySelector('select[name="metode_pembayaran"]');
            const modalQris = new bootstrap.Modal(document.getElementById('qrisModal'));

            $('#submitOrder').on('click', function () {
                if (metodeSelect.value === 'qris') {
                    modalQris.show(); // tampilkan QR modal
                } else {
                    form.submit(); // langsung submit
                }
            });

            $('#confirmQris').on('click', function () {
                modalQris.hide();
                form.submit(); // submit saat bayar
            });
            $('#cancelQris').on('click', function () {
                modalQris.hide(); // cukup tutup modal, jangan reload
            });
        });
    </script>
@endpush