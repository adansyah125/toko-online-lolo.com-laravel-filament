<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>LOLO</title>

    <!-- POPPINS FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />

    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- TAILWIND CDN -->
    @vite('resources/css/app.css')
    <style>
        body {
            font-family: "Poppins", sans-serif;
        }
    </style>
</head>


<body class="bg-[#f9f9f9] text-[#333]">
    <!-- HEADER -->
    @include('layouts.navbar')

    <div>
        @yield('content')

    </div>

    <!-- FOOTER -->



    <!-- SLIDER SCRIPT -->
    <script>
        const bannerSlide = document.getElementById("bannerSlide");
        let currentBanner = 0;
        const total = bannerSlide.children.length;

        function updateSlide() {
            bannerSlide.style.transform = `translateX(-${currentBanner * 100}%)`;
        }

        setInterval(() => {
            currentBanner = (currentBanner + 1) % total;
            updateSlide();
        }, 5000);
    </script>

    {{-- //badge keranjang --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.addToCartBtn').click(function(e) {
                e.preventDefault();
                let productId = $(this).data('id');
                let qty = $(this).data('qty') || 1;

                $.ajax({
                    url: "{{ route('cart.add') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_id: productId,
                        qty: qty
                    },
                    success: function(res) {
                        // res.cart_count dikirim dari controller
                        $('#cartBadge').text(res.cart_count);

                        // opsional: toast notifikasi
                        alert('Produk berhasil ditambahkan ke keranjang!');
                    },
                    error: function(err) {
                        console.error(err);
                    }
                });
            });
        });
    </script>



</body>

</html>
