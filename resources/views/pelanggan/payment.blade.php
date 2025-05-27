<!-- resources/views/pelanggan/payment.blade.php -->
<html>

<head>
    <title>Pembayaran</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
</head>

<body>
    <h2>Total: Rp{{ number_format($order->total, 0, ',', '.') }}</h2>
    <button id="pay-button">Bayar Sekarang</button>

    <script>
        document.getElementById('pay-button').addEventListener('click', function() {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    alert("Pembayaran berhasil!");
                    console.log(result);
                    // Redirect ke halaman sukses (opsional)
                },
                onPending: function(result) {
                    alert("Menunggu pembayaran...");
                    console.log(result);
                },
                onError: function(result) {
                    alert("Pembayaran gagal!");
                    console.log(result);
                },
                onClose: function() {
                    alert("Kamu menutup popup pembayaran.");
                }
            });
        });
    </script>
</body>

</html>
