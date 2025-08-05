@extends('layout')
@section('content')
    <div class="w-full">
        <div class="py-4 md:py-7">
            <div class="flex items-center justify-between">
                <p tabindex="0"
                    class="focus:outline-none text-base sm:text-lg md:text-xl lg:text-2xl font-bold leading-normal text-gray-800">
                    Daftar Produk</p>
                <div
                    class="py-3 px-4 flex items-center text-sm font-medium leading-none text-gray-600 bg-white hover:bg-gray-300 cursor-pointer rounded">
                    <p>Sort By:</p>
                    <select id="sort-select" aria-label="select"
                        class="focus:text-indigo-600 focus:outline-none bg-transparent ml-1">
                        <option value="latest" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                        <option value="brand_asc" {{ request('sort') == 'brand_asc' ? 'selected' : '' }}>Merek (A-Z)</option>
                        <option value="brand_desc" {{ request('sort') == 'brand_desc' ? 'selected' : '' }}>Merek (Z-A)</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga (Rendah-Tinggi)</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga (Tinggi-Rendah)</option>
                        <option value="stock_asc" {{ request('sort') == 'stock_asc' ? 'selected' : '' }}>Stok (Sedikit-Banyak)</option>
                        <option value="stock_desc" {{ request('sort') == 'stock_desc' ? 'selected' : '' }}>Stok (Banyak-Sedikit)</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl py-4 md:py-7 px-4 md:px-8 xl:px-10">
            <div class="sm:flex items-center justify-between">
                <form id="search-form" action="{{ route('produk.index') }}" method="GET" class="relative">
                    <input type="search" name="search" id="search-input" value="{{ request('search') }}"
                        class="peer cursor-pointer relative z-10 h-10 w-10 rounded-full border-2 border-gray-300 bg-transparent pl-12 outline-none focus:w-64 focus:cursor-text focus:border-blue-500 focus:pl-16 focus:pr-4 transition-all duration-300"
                        placeholder="{{ request('search') ? '' : 'Search...' }}" />
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="absolute inset-y-0 my-auto h-8 w-12 border-r border-transparent stroke-gray-500 px-3.5 peer-focus:border-blue-500 peer-focus:stroke-blue-600 clickable-search-icon"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="hidden" name="sort" id="sort-value" value="{{ request('sort', 'latest') }}">
                </form>

                <button onclick="popuphandler(true)"
                    class="focus:ring-2 cursor-pointer focus:ring-offset-2 focus:ring-indigo-600 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-gradient-to-tr from-blue-600 to-blue-400 shadow-md shadow-blue-500/20 hover:bg-indigo-600 focus:outline-none rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus text-white" viewBox="0 0 16 16">
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                    </svg>
                    <p class="text-sm  font-medium leading-none text-white">Tambah Produk</p>
                </button>
            </div>

            <div class="mt-7 overflow-x-auto">
                <table class="w-full whitespace-nowrap">
                    <thead>
                        <tr>
                            <th class="text-left text-xs font-semibold text-gray-600 uppercase">No.</th>
                            <th class="text-left text-xs font-semibold text-gray-600 uppercase">Merek</th>
                            <th class="text-left text-xs font-semibold text-gray-600 uppercase">Tipe</th>
                            <th class="text-left text-xs font-semibold text-gray-600 uppercase">Harga</th>
                            <th class="text-left text-xs font-semibold text-gray-600 uppercase">Stok</th>
                            <th class="text-left text-xs font-semibold text-gray-600 uppercase">Deskripsi</th>
                            <th class="text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($products as $index => $product)
                            <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                                <td class="pl-4">{{ $index + 1 }}</td>
                                <td class="">
                                    <div class="flex items-center">
                                        <p class="text-base font-medium leading-none text-gray-700 mr-2">
                                            {{ $product->brand ?? '-' }}</p>
                                    </div>
                                </td>
                                <td class="">
                                    <p class="text-sm leading-none text-gray-600">{{ $product->type ?? '-' }}</p>
                                </td>
                                <td class="">
                                    <p class="text-sm leading-none text-gray-600">Rp
                                        {{ number_format($product->price, 0, ',', '.') }}</p>
                                </td>
                                <td class="">
                                    <span class="px-2 py-1 text-xs rounded-full {{ $product->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $product->stock }}
                                    </span>
                                </td>
                                <td class="">
                                    <p class="text-sm leading-none text-gray-600 truncate max-w-xs">
                                        {{ $product->description ?? '-' }}</p>
                                </td>
                                <td class="">
                                    <div class="flex items-center space-x-2">
                                        <button
                                            class="p-1 cursor-pointer text-green-600 hover:text-green-800 focus:outline-none"
                                            title="View Details" onclick="showDetailModal({{ $product->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd"
                                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>

                                        <button
                                            class="p-1 cursor-pointer text-blue-600 hover:text-blue-800 focus:outline-none"
                                            title="Edit" onclick="showEditModal({{ $product->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </button>

                                        <button
                                            class="p-1 cursor-pointer text-red-600 hover:text-red-800 focus:outline-none"
                                            title="Delete"
                                            onclick="confirmDelete({{ $product->id }}, '{{ $product->brand }} - {{ $product->type }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="h-3"></tr>
                        @endforeach

                        @if ($products->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center py-4 text-gray-500">
                                    Tidak ada data produk
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div id="modal-backdrop"
        class="hidden fixed inset-0 bg-black/20 backdrop-blur-md z-[1000] transition-all duration-300">
    </div>

    <div id="tambah-produk-modal"
        class="hidden fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-lg z-[1001] transition-all duration-300 scale-95 opacity-0">
        <div class="bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/20 mx-4">
            <div class="p-8">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-2xl font-bold bg-gradient-to-r from-gray-900 to-gray-600 bg-clip-text text-transparent">
                        Tambah Produk Baru
                    </h3>
                    <button onclick="popuphandler(false)"
                        class="p-2 rounded-full cursor-pointer hover:bg-gray-100/80 transition-colors group">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-gray-500 group-hover:text-gray-700 transition-colors" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form id="product-form" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-2">
                        <label for="brand" class="block text-sm font-semibold text-gray-700">Merek Produk</label>
                        <input type="text" id="brand" name="brand" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/50 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 placeholder:text-gray-400"
                            placeholder="Masukkan merek produk">
                        <div id="brand-error" class="text-red-500 text-xs mt-1 hidden"></div>
                    </div>

                    <div class="space-y-2">
                        <label for="type" class="block text-sm font-semibold text-gray-700">Tipe Produk</label>
                        <input type="text" id="type" name="type" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/50 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 placeholder:text-gray-400"
                            placeholder="Masukkan tipe produk">
                        <div id="type-error" class="text-red-500 text-xs mt-1 hidden"></div>
                    </div>

                    <div class="space-y-2">
                        <label for="price" class="block text-sm font-semibold text-gray-700">Harga (Rp)</label>
                        <input type="number" id="price" name="price" min="0" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/50 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 placeholder:text-gray-400"
                            placeholder="0">
                        <div id="price-error" class="text-red-500 text-xs mt-1 hidden"></div>
                    </div>

                    <div class="space-y-2">
                        <label for="stock" class="block text-sm font-semibold text-gray-700">Stok</label>
                        <input type="number" id="stock" name="stock" min="0" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/50 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 placeholder:text-gray-400"
                            placeholder="0">
                        <div id="stock-error" class="text-red-500 text-xs mt-1 hidden"></div>
                    </div>

                    <div class="space-y-2">
                        <label for="description" class="block text-sm font-semibold text-gray-700">Deskripsi</label>
                        <textarea id="description" name="description" rows="3"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/50 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 placeholder:text-gray-400 resize-none"
                            placeholder="Masukkan deskripsi produk (opsional)"></textarea>
                        <div id="description-error" class="text-red-500 text-xs mt-1 hidden"></div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4">
                        <button type="button" onclick="popuphandler(false)"
                            class="px-6 py-2 cursor-pointer rounded-xl border border-gray-200 hover:bg-gray-50/80 transition-all duration-200 bg-transparent text-gray-700 font-medium">
                            Batal
                        </button>
                        <button type="submit" id="submit-btn"
                            class="px-6 py-2 cursor-pointer rounded-xl bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white shadow-lg hover:shadow-xl transition-all duration-200 font-medium">
                            <span class="submit-text">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div id="detail-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
        <div class="fixed inset-0 bg-white/20 bg-opacity-30 backdrop-blur-sm transition-all duration-300"></div>

        <div class="flex min-h-screen items-center justify-center p-4 transition-all duration-300">
            <div
                class="relative w-full max-w-2xl rounded-2xl bg-white/80 backdrop-blur-lg shadow-2xl ring-1 ring-black/5 overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <h3 class="text-2xl font-bold text-gray-800">Detail Produk</h3>
                        <button onclick="closeDetailModal()" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="mt-6 space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="bg-white/50 p-4 rounded-xl shadow-sm">
                                <p class="text-sm font-medium text-gray-500">Merek</p>
                                <p id="detail-product-brand" class="mt-1 text-lg font-semibold text-gray-800"></p>
                            </div>
                            <div class="bg-white/50 p-4 rounded-xl shadow-sm">
                                <p class="text-sm font-medium text-gray-500">Tipe</p>
                                <p id="detail-product-type" class="mt-1 text-lg font-semibold text-gray-800"></p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="bg-white/50 p-4 rounded-xl shadow-sm">
                                <p class="text-sm font-medium text-gray-500">Harga</p>
                                <p id="detail-product-price" class="mt-1 text-lg font-semibold text-gray-800"></p>
                            </div>
                            <div class="bg-white/50 p-4 rounded-xl shadow-sm">
                                <p class="text-sm font-medium text-gray-500">Stok</p>
                                <p id="detail-product-stock" class="mt-1 text-lg font-semibold text-gray-800"></p>
                            </div>
                        </div>

                        <div class="bg-white/50 p-4 rounded-xl shadow-sm">
                            <p class="text-sm font-medium text-gray-500">Deskripsi</p>
                            <p id="detail-product-description" class="mt-1 text-gray-700"></p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="bg-white/50 p-4 rounded-xl shadow-sm">
                                <p class="text-sm font-medium text-gray-500">Dibuat Pada</p>
                                <p id="detail-product-created" class="mt-1 text-gray-700"></p>
                            </div>
                            <div class="bg-white/50 p-4 rounded-xl shadow-sm">
                                <p class="text-sm font-medium text-gray-500">Diupdate Pada</p>
                                <p id="detail-product-updated" class="mt-1 text-gray-700"></p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <button onclick="closeDetailModal()"
                            class="px-6 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition duration-200">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showEditModal(productId) {
            window.location.href = `master-produk/${productId}/edit`;
        }

        function closeDetailModal() {
            document.getElementById('detail-modal').classList.add('hidden');
        }

        function showDetailModal(productId) {
            fetch(`master-produk/${productId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Produk tidak ditemukan');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        const product = data.data;
                        document.getElementById('detail-product-brand').textContent = product.brand || '-';
                        document.getElementById('detail-product-type').textContent = product.type || '-';
                        document.getElementById('detail-product-price').textContent = 'Rp ' + product.price
                            .toLocaleString('id-ID');
                        document.getElementById('detail-product-stock').textContent = product.stock;
                        document.getElementById('detail-product-description').textContent = product.description || '-';
                        document.getElementById('detail-product-created').textContent = new Date(product.created_at).toLocaleString('id-ID');
                        document.getElementById('detail-product-updated').textContent = product.updated_at ? 
                            new Date(product.updated_at).toLocaleString('id-ID') : 'Belum pernah diupdate';

                        document.getElementById('detail-modal').classList.remove('hidden');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message,
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal memuat detail produk: ' + error.message,
                    });
                });
        }

        function confirmDelete(productId, productName) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                html: `Produk <b>"${productName}"</b> akan dihapus permanen.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                backdrop: `
            rgba(0,0,0,0.4)
            url("/images/nyan-cat.gif")
            left top
            no-repeat
        `
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`master-produk/${productId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: data.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: data.message,
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Gagal menghapus produk',
                            });
                        });
                }
            });
        }

        function popuphandler(val) {
            const modal = document.getElementById('tambah-produk-modal');
            const backdrop = document.getElementById('modal-backdrop');

            if (val) {
                modal.classList.remove('hidden');
                backdrop.classList.remove('hidden');

                setTimeout(() => {
                    modal.classList.remove('scale-95', 'opacity-0');
                    modal.classList.add('scale-100', 'opacity-100');
                }, 10);
                document.body.style.overflow = 'hidden';

            } else {
                modal.classList.remove('scale-100', 'opacity-100');
                modal.classList.add('scale-95', 'opacity-0');

                setTimeout(() => {
                    modal.classList.add('hidden');
                    backdrop.classList.add('hidden');
                }, 300);
                document.body.style.overflow = 'auto';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('product-form');

            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                const submitBtn = document.getElementById('submit-btn');
                const submitText = submitBtn.querySelector('.submit-text');

                submitText.textContent = 'Menyimpan...';
                submitBtn.disabled = true;

                try {
                    document.querySelectorAll('[id$="-error"]').forEach(el => {
                        el.classList.add('hidden');
                        el.textContent = '';
                    });

                    const formData = new FormData(form);
                    const response = await fetch('{{ route('produk.store') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        if (data.errors) {
                            Object.keys(data.errors).forEach(field => {
                                const errorElement = document.getElementById(`${field}-error`);
                                if (errorElement) {
                                    errorElement.textContent = data.errors[field][0];
                                    errorElement.classList.remove('hidden');
                                }
                            });
                            throw new Error('Validasi gagal');
                        }
                        throw new Error(data.message || 'Terjadi kesalahan saat menyimpan data');
                    }
                    Swal.fire({
                        title: 'Berhasil!',
                        text: data.message || 'Produk berhasil ditambahkan',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        form.reset();
                        popuphandler(false);
                        window.location.reload();
                    });
                } catch (error) {
                    console.error('Error:', error);

                    if (!error.message.includes('Validasi')) {
                        Swal.fire({
                            title: 'Gagal!',
                            text: error.message || 'Terjadi kesalahan saat menyimpan data',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                } finally {
                    submitText.textContent = 'Simpan';
                    submitBtn.disabled = false;
                }
            });

            // Search and sort functionality
            const searchForm = document.getElementById('search-form');
            const searchInput = document.getElementById('search-input');
            const sortSelect = document.getElementById('sort-select');
            const sortInput = document.getElementById('sort-value');
            const searchIcon = document.querySelector('.clickable-search-icon');
            
            sortSelect.addEventListener('change', function() {
                sortInput.value = this.value;
                searchForm.submit();
            });
            
            searchIcon.addEventListener('click', function(e) {
                e.preventDefault();
                searchForm.submit();
            });
            
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    searchForm.submit();
                }
            });
            
            if (searchInput.value) {
                searchInput.style.width = '16rem';
                searchInput.style.paddingLeft = '4rem';
                searchInput.style.paddingRight = '1rem';
                searchInput.style.cursor = 'text';
            }

            // Auto-resize textarea
            document.getElementById('description').addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = this.scrollHeight + 'px';
            });
        });
    </script>

    <style>
        .backdrop-blur-sm {
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }

        .backdrop-blur-md {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .backdrop-blur-xl {
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
        }

        input:focus,
        textarea:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        textarea::-webkit-scrollbar {
            width: 4px;
        }

        textarea::-webkit-scrollbar-track {
            background: transparent;
        }

        textarea::-webkit-scrollbar-thumb {
            background: rgba(156, 163, 175, 0.5);
            border-radius: 2px;
        }

        textarea::-webkit-scrollbar-thumb:hover {
            background: rgba(156, 163, 175, 0.7);
        }

        .checkbox:checked+.check-icon {
            display: flex;
        }
    </style>
@endsection