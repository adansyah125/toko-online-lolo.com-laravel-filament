<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Lupa Password</title>
</head>

<div id="toast"
    class="hidden fixed top-5 right-5 z-50 px-4 py-3 rounded-lg shadow-lg text-white text-sm transition-all duration-300">
</div>

<body class="bg-zinc-400 flex justify-center items-center min-h-screen px-4">

    <div class="bg-white p-6 sm:p-8 rounded-xl w-full max-w-md text-white shadow-xl">

        {{-- <h2 class="text-2xl font-bold mb-3 text-center text-black">Lupa Password</h2> --}}
        <p class="mb-5 text-gray-400 text-center text-sm sm:text-base">
            Masukkan email Anda, kami akan mengirimkan link reset password.
        </p>

        @if (session('status'))
            <div class="bg-green-600 p-3 rounded mb-4 text-center text-sm sm:text-base">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <label class="block mb-1 text-sm font-medium text-black">Email</label>
            <input type="email" name="email"
                class="w-full p-2 rounded border  border-gray-400 text-black focus:ring-2 focus:ring-green-500 transition text-sm sm:text-base"
                placeholder="Masukkan email Anda" required>

            <button
                class="w-full bg-green-700 py-2 rounded hover:bg-green-600 mt-4 transition-all duration-300 text-sm sm:text-base">
                Kirim Link Reset
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="/login" class="text-blue-400 hover:underline text-sm sm:text-base">Kembali ke Login</a>
        </div>
    </div>

</body>

<script>
    function showToast(message, type = "success") {
        const toast = document.getElementById("toast");

        toast.textContent = message;

        if (type === "error") {
            toast.className = "fixed top-5 right-5 z-50 px-4 py-3 rounded-lg shadow-lg text-white text-sm bg-red-600";
        } else {
            toast.className = "fixed top-5 right-5 z-50 px-4 py-3 rounded-lg shadow-lg text-white text-sm bg-green-600";
        }

        toast.style.opacity = "1";
        toast.style.transform = "translateY(0)";

        setTimeout(() => {
            toast.style.opacity = "0";
            toast.style.transform = "translateY(-20px)";
        }, 3000);

        setTimeout(() => {
            toast.classList.add("hidden");
        }, 3500);
    }
</script>

<script>
    @if (session('toast_success'))
        showToast("{{ session('toast_success') }}", "success");
    @endif

    @if (session('toast_error'))
        showToast("{{ session('toast_error') }}", "error");
    @endif
</script>

</html>
