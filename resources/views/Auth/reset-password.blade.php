<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Reset Password</title>
</head>

<body class="bg-zinc-400 flex justify-center items-center min-h-screen px-4">

    <div class="bg-white p-6 sm:p-8 rounded-xl w-full max-w-md text-white shadow-xl">

        <h2 class="text-2xl font-bold mb-4 text-center text-black">Reset Password</h2>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <label class="block text-sm font-medium">Email</label>
            <input type="email" name="email"
                class="w-full p-2 rounded  border border-gray-600 text-black text-sm sm:text-base focus:ring-2 focus:ring-green-500 transition mb-3"
                placeholder="Masukkan email Anda" required>

            <label class="block text-sm font-medium">Password Baru</label>
            <input type="password" name="password"
                class="w-full p-2 rounded  border border-gray-600 text-black text-sm sm:text-base focus:ring-2 focus:ring-green-500 transition mb-3"
                placeholder="Masukkan password baru" required>

            <label class="block text-sm font-medium">Konfirmasi Password</label>
            <input type="password" name="password_confirmation"
                class="w-full p-2 rounded  border border-gray-600 text-black text-sm sm:text-base focus:ring-2 focus:ring-green-500 transition mb-4"
                placeholder="Ulangi password baru" required>

            <button class="w-full bg-green-700 py-2 rounded hover:bg-green-600 transition text-sm sm:text-base">
                Reset Password
            </button>
        </form>
    </div>

</body>

</html>
