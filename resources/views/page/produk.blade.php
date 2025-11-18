@extends('layouts.app')

@section('content')
    <section class="max-w-[1200px] mx-auto px-6 mt-10 pb-20">

        <!-- TITLE + SEARCH -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            {{-- <h2 class="text-[1.8rem] font-bold text-[#ff6f00]">Semua Produk</h2> --}}

            <input id="searchInput" type="text" placeholder="Cari produk..."
                class="w-full md:w-[300px] px-4 py-2 rounded-full border border-gray-300 focus:border-[#ff6f00] outline-none">
        </div>

        <!-- FILTER KATEGORI -->
        <div class="flex gap-3 overflow-auto pb-3 mt-3" id="categoryFilter">

            <!-- BUTTON SEMUA -->
            <button data-category="all" class="filter-btn px-5 py-2 rounded-full bg-[#ff6f00] text-white whitespace-nowrap">
                Semua
            </button>

            @foreach ($kategori as $kat)
                <button data-category="{{ $kat->id }}"
                    class="filter-btn px-5 py-2 rounded-full border border-gray-300 text-gray-700 whitespace-nowrap">
                    {{ $kat->nama }}
                </button>
            @endforeach

        </div>

        <!-- LIST PRODUK -->
        <div id="produkList" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-5 mt-8">
            @forelse ($produk as $item)
                <div class="produk-card bg-white rounded-xl shadow hover:shadow-xl transition overflow-hidden flex flex-col"
                    data-category="{{ $item->category_id }}" data-name="{{ strtolower($item->nama) }}">

                    <img src="{{ asset('storage/' . $item->image1) }}" class="w-full h-[150px] object-cover">

                    <div class="p-6 flex flex-col h-full">

                        <p class="text-sm text-gray-600">{{ $item->Category->nama }}</p>

                        <h3 class="font-semibold text-lg">{{ $item->nama }}</h3>

                        <p class="text-sm text-gray-500 line-clamp-2">
                            {{ $item->deskripsi }}
                        </p>

                        <p class="text-green-600 font-bold text-lg mb-2">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </p>

                        <a href="{{ route('detail-produk', $item->id) }}"
                            class="mt-auto px-4 py-2 bg-[#ff6f00] text-white rounded-lg shadow-lg 
                  hover:bg-[#e65c00] text-center block">
                            Lihat Produk
                        </a>

                    </div>
                </div>
            @empty
                <div class="col-span-2 sm:col-span-3 md:col-span-4 text-center text-gray-500 py-10">
                    Produk tidak tersedia.
                </div>
            @endforelse
        </div>

        <!-- Placeholder untuk JS -->
        <div id="emptyMessage" class="col-span-2 sm:col-span-3 md:col-span-4 text-center text-gray-500 py-10 hidden">
            Produk tidak tersedia.
        </div>


        <!-- PAGINATION BEAUTIFUL STYLE -->
        <div class="mt-12 flex justify-center">
            <div class="inline-flex space-x-1">

                {{-- Previous Page --}}
                @if ($produk->onFirstPage())
                    <span class="px-4 py-2 bg-gray-200 text-gray-400 rounded-lg cursor-not-allowed">
                        «
                    </span>
                @else
                    <a href="{{ $produk->previousPageUrl() }}"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        «
                    </a>
                @endif

                {{-- Numbers --}}
                @foreach ($produk->links()->elements[0] ?? [] as $page => $url)
                    @if ($page == $produk->currentPage())
                        <span
                            class="px-4 py-2 bg-[#ff6f00] text-white rounded-lg shadow-lg font-semibold scale-105 transition">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-[#ff6f00] hover:text-white transition">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                {{-- Next Page --}}
                @if ($produk->hasMorePages())
                    <a href="{{ $produk->nextPageUrl() }}"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        »
                    </a>
                @else
                    <span class="px-4 py-2 bg-gray-200 text-gray-400 rounded-lg cursor-not-allowed">
                        »
                    </span>
                @endif

            </div>
        </div>


    </section>

    {{-- JS FILTER --}}
    <script>
        const searchInput = document.getElementById("searchInput");
        const produkCards = document.querySelectorAll(".produk-card");
        const filterBtns = document.querySelectorAll(".filter-btn");
        const emptyMessage = document.getElementById("emptyMessage");

        let selectedCategory = "all";

        // Klik tombol kategori
        filterBtns.forEach(btn => {
            btn.addEventListener("click", () => {
                filterBtns.forEach(b => b.classList.remove("bg-[#ff6f00]", "text-white"));
                btn.classList.add("bg-[#ff6f00]", "text-white");
                selectedCategory = btn.dataset.category;
                filterProducts();
            });
        });

        // Search realtime
        searchInput.addEventListener("keyup", filterProducts);

        // Filter function
        function filterProducts() {
            const searchValue = searchInput.value.toLowerCase();
            let visibleCount = 0;

            produkCards.forEach(card => {
                const cardName = card.dataset.name;
                const cardCat = card.dataset.category;

                const matchCategory = selectedCategory === "all" || selectedCategory === cardCat;
                const matchSearch = cardName.includes(searchValue);

                if (matchCategory && matchSearch) {
                    card.classList.remove("hidden");
                    visibleCount++;
                } else {
                    card.classList.add("hidden");
                }
            });

            // Tampilkan atau sembunyikan pesan kosong
            if (visibleCount === 0) {
                emptyMessage.classList.remove("hidden");
            } else {
                emptyMessage.classList.add("hidden");
            }
        }
    </script>
@endsection
