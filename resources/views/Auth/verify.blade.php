<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <div class="max-w-md mx-auto text-center mt-10">
        <h2 class="text-2xl font-bold mb-4">Verifikasi Email Anda</h2>

        <p class="mb-6 text-gray-600">
            Kami telah mengirimkan link verifikasi ke email Anda.
            Jika tidak menerima, klik tombol di bawah untuk mengirim ulang.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                Link verifikasi telah dikirim ulang!
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-800">
                Kirim Ulang Email Verifikasi
            </button>
        </form>
    </div>


</body>

</html>
