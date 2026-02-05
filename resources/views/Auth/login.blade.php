<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'glyphicons-halflings', sans-serif;
        }

        /* Fade-in animation */
        .fade-in {
            animation: fadeIn 0.8s ease forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        /* Input focus dark mode */
        input:focus {
            outline: none;
        }
    </style>
</head>
<div id="toast"
    class="hidden fixed top-5 right-5 z-50 px-4 py-3 rounded-lg shadow-lg text-black text-sm transition-all duration-300">
</div>

<body class="bg-zinc-400 sm:px-0 px-4 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md fade-in">
        {{-- <h2 class="text-2xl font-bold text-center text-gray-300 mb-1">PK 1.2</h2> --}}
        <img src="{{ asset('logo.png') }}" alt="" class="m-auto" style="width: 80px; height:60px">
        <p class="text-center text-black mb-6">Silahkan untuk Login terlebih dahulu</p> {{-- Session error --}}
        @if (session('error'))
            <div class="bg-red-600 text-black p-3 rounded mb-3"> {{ session('error') }} </div>
        @endif
        <form id="loginForm" action="{{ route('user.login.post') }}" method="POST" class="space-y-4"> @csrf <div>
                <label class="block mb-1 text-sm font-medium text-black">Email</label> <input type="email"
                    name="email"
                    class="w-full border  rounded-lg p-2  text-black placeholder-gray-400 focus:ring-2 focus:ring-green-400 transition"
                    placeholder="Email Account" required>

            </div>
            <div>
                <label class="block mb-1 text-sm font-medium text-black">Password</label>

                <div class="relative items-center justify-center">
                    <input type="password" id="passwordField" name="password" required
                        class="w-full border  rounded-lg p-2 pr-10  text-black placeholder-gray-400 focus:ring-2 focus:ring-green-400 transition">

                    <!-- ICON MATA -->
                    <button type="button" id="togglePassword"
                        class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-black">

                        <!-- Mata terbuka -->
                        <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 12c0 0 3.75-7.5 9.75-7.5s9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>

                        <!-- Mata tertutup -->
                        <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hidden">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 3l18 18M9.88 9.88A3 3 0 0114.12 14.12M6.28 6.28C4.47 7.64 3 9.94 3 12c0 0 3.75 7.5 9.75 7.5 1.61 0 3.11-.33 4.46-.92M17.72 17.72c1.81-1.36 3.28-3.66 3.28-5.72 0 0-3.75-7.5-9.75-7.5-1.61 0-3.11.33-4.46.92" />
                        </svg>

                    </button>
                </div>
            </div>
            <div class="text-right mt-2">
                <a href="{{ route('password.request') }}" class="text-blue-400 text-sm hover:underline">
                    Lupa Password?
                </a>
            </div>

            <button id="submitBtn" type="submit"
                class="w-full bg-green-800 text-white py-2 rounded-lg hover:bg-green-700 transition duration-300 disabled:bg-gray-600 disabled:cursor-not-allowed">
                Login </button>


        </form>
        <div class="mt-6 text-center text-sm text-gray-400"> Belum punya akun? <a href="/register"
                class="text-blue-500 font-semibold hover:underline"> Daftar </a> </div>
        <div class="flex items-center my-6">
            <div class="flex-grow h-px bg-gray-600"></div> <span class="px-3 text-gray-400 text-sm">atau</span>
            <div class="flex-grow h-px bg-gray-600"></div>
        </div> {{-- Login Google --}} <a href="{{ route('google.redirect') }}"
            class="w-full flex items-center justify-center gap-2 border border-black py-2 rounded-lg hover:bg-gray-300 transition duration-300 text-black">
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5"> <span>Login dengan
                Google</span> </a>
    </div>

</body>
<script>
    const passwordField = document.getElementById("passwordField");
    const togglePassword = document.getElementById("togglePassword");
    const eyeOpen = document.getElementById("eyeOpen");
    const eyeClosed = document.getElementById("eyeClosed");

    togglePassword.addEventListener("click", () => {
        const isHidden = passwordField.type === "password";

        passwordField.type = isHidden ? "text" : "password";

        eyeOpen.classList.toggle("hidden");
        eyeClosed.classList.toggle("hidden");
    });
</script>

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
                    ok.innerHTML = "Data valid";

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

        if (type === "error") {
            toast.className = "fixed top-5 right-5 z-50 px-4 py-3 rounded-lg shadow-lg text-black text-sm bg-red-600";
        } else {
            toast.className = "fixed top-5 right-5 z-50 px-4 py-3 rounded-lg shadow-lg text-black text-sm bg-green-600";
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
