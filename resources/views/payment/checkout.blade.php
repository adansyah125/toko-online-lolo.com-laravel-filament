<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

<button id="pay-button" class="btn btn-warning">Bayar Sekarang</button>

<script>
    document.getElementById('pay-button').onclick = function() {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                window.location.href = "{{ route('payment.success', $order->order_id) }}";
            },
            onPending: function(result) {
                window.location.href = "{{ route('pesanan', $order->order_id) }}";
            },
            onError: function(result) {
                alert("Pembayaran gagal, coba lagi!");
            }
        });
    };
</script>
