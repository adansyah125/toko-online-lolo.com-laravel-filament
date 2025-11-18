<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<div id="toast"
    class="hidden fixed top-5 right-5 z-50 px-4 py-3 rounded-lg shadow-lg text-white text-sm transition-all duration-300">
</div>

<body class="bg-gray-100 sm:px-0 px-4 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8  rounded-2xl shadow-xl w-full max-w-md">

        <h2 class="text-2xl font-bold text-center mb-6">Login</h2>

        {{-- Session error --}}
        @if (session('error'))
            <div class="bg-red-100 text-red-600 p-3 rounded mb-3">
                {{ session('error') }}
            </div>
        @endif

        <form id="loginForm" action="{{ route('user.login.post') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 text-sm font-medium">Email</label>
                <input type="email" name="email"
                    class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-orange-400">
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium">Password</label>
                <input type="password" name="password"
                    class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-orange-400">
            </div>

            <button id="submitBtn" type="submit"
                class="w-full bg-orange-500 text-white py-2 rounded-lg hover:bg-orange-600 transition disabled:bg-gray-400 disabled:cursor-not-allowed">
                Login
            </button>

            <span id="loading" class="hidden text-sm text-gray-600">Sedang memeriksa...</span>
        </form>


        <div class="mt-6 text-center text-sm text-gray-600">
            Belum punya akun?
            <a href="/register" class="text-orange-500 font-semibold hover:underline">
                Daftar
            </a>
        </div>

        <div class="flex items-center my-6">
            <div class="flex-grow h-px bg-gray-300"></div>
            <span class="px-3 text-gray-500 text-sm">atau</span>
            <div class="flex-grow h-px bg-gray-300"></div>
        </div>

        {{-- Login Google --}}
        <a href="{{ route('google.redirect') }}"
            class="w-full flex items-center justify-center gap-2 border py-2 rounded-lg hover:bg-gray-50 transition">
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5">
            <span>Login dengan Google</span>
        </a>

    </div>

</body>

<script>
    const loginForm = document.getElementById("loginForm");
    const loginInputs = document.querySelectorAll("input[name='email'], input[name='password']");
    const loginBtn = document.getElementById("submitBtn");
    const loginLoader = document.getElementById("loading");

    let delay = null;

    loginInputs.forEach(input => {
        input.addEventListener("input", () => {
            clearTimeout(delay);

            delay = setTimeout(() => validateLogin(), 400);
        });
    });

    async function validateLogin() {
        loginLoader.classList.remove("hidden");

        let formData = new FormData(loginForm);

        let response = await fetch("{{ route('validate.login') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
            body: formData
        });

        let result = await response.json();

        document.querySelectorAll(".login-error").forEach(e => e.remove());
        document.querySelectorAll(".login-success").forEach(e => e.remove());

        loginInputs.forEach(input => {
            input.classList.remove("border-red-500", "border-green-500");
        });

        if (result.errors) {
            loginBtn.disabled = true;

            Object.keys(result.errors).forEach(field => {
                let input = document.querySelector(`[name="${field}"]`);

                input.classList.add("border-red-500");

                let errorDiv = document.createElement("div");
                errorDiv.classList.add("login-error", "text-red-500", "text-xs", "mt-1");
                errorDiv.innerHTML = result.errors[field][0];

                input.insertAdjacentElement("afterend", errorDiv);
            });

        } else {
            loginBtn.disabled = false;

            loginInputs.forEach(input => {
                if (input.value.trim().length > 0) {
                    input.classList.add("border-green-500");

                    let ok = document.createElement("div");
                    ok.classList.add("login-success", "text-green-600", "text-xs", "mt-1");
                    ok.innerHTML = "✔ Data valid";

                    input.insertAdjacentElement("afterend", ok);
                }
            });
        }

        loginLoader.classList.add("hidden");
    }
</script>

<script>
    function showToast(message, type = "success") {
        const toast = document.getElementById("toast");

        toast.textContent = message;

        // warna berdasarkan status
        if (type === "error") {
            toast.className = "fixed top-5 right-5 z-50 px-4 py-3 rounded-lg shadow-lg text-white text-sm bg-red-600";
        } else {
            toast.className = "fixed top-5 right-5 z-50 px-4 py-3 rounded-lg shadow-lg text-white text-sm bg-green-600";
        }

        toast.style.opacity = "1";
        toast.style.transform = "translateY(0)";

        // auto hilang
        setTimeout(() => {
            toast.style.opacity = "0";
            toast.style.transform = "translateY(-20px)";
        }, 3000);

        // remove element setelah animasi
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
