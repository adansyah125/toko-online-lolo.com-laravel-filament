<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>

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

<body class="bg-gray-900 sm:px-0 px-4 flex items-center justify-center min-h-screen">

    <div class="bg-gray-800 p-8 rounded-2xl shadow-xl w-full max-w-md fade-in">
        <h2 class="text-2xl font-bold text-center text-gray-300 mb-1">PK 1.2</h2>
        <p class="text-center text-gray-300 mb-6">Isi form dibawah ini untuk mendaftar</p>
        <form id="registerForm" action="{{ route('user.register.post') }}" method="POST" class="space-y-4"> @csrf <div>
                <label class="block mb-1 text-sm font-medium text-gray-200">Nama Lengkap</label> <input type="text"
                    name="name" required
                    class="w-full border border-gray-600 rounded-lg p-2 bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-green-400 transition">
            </div>
            <div> <label class="block mb-1 text-sm font-medium text-gray-200">Email</label> <input type="email"
                    name="email" required
                    class="w-full border border-gray-600 rounded-lg p-2 bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-green-400 transition">
            </div>
            <div> <label class="block mb-1 text-sm font-medium text-gray-200">Password</label> <input type="password"
                    name="password" required
                    class="w-full border border-gray-600 rounded-lg p-2 bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-green-400 transition">
            </div> <button type="submit" id="submitBtn"
                class="w-full bg-green-700 text-white py-2 rounded-lg hover:bg-green-800 transition duration-300">
                Daftar </button> <span id="loading" class="hidden text-sm text-gray-400">Sedang memeriksa...</span>
        </form>
        <div class="text-center mt-6 text-sm text-gray-400"> Sudah punya akun? <a href="/login"
                class="text-blue-500 font-semibold hover:underline"> Login </a> </div>
    </div>

</body>
<script>
    const form = document.getElementById("registerForm");
    const inputs = document.querySelectorAll("input[name='name'], input[name='email'], input[name='password']");
    const submitBtn = document.getElementById("submitBtn");

    const loadingText = document.getElementById("loading");
    loadingText.textContent = "Sedang memeriksa...";

    let timeout = null;

    inputs.forEach(input => {
        input.addEventListener("input", () => {
            clearTimeout(timeout);

            timeout = setTimeout(() => validate(), 400);
        });
    });

    async function validate() {
        loadingText.classList.remove("hidden");

        let formData = new FormData(form);

        let response = await fetch("{{ route('validate.register') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
            body: formData,
        });

        let result = await response.json();

        document.querySelectorAll(".error-msg").forEach(e => e.remove());
        document.querySelectorAll(".success-msg").forEach(e => e.remove());

        inputs.forEach(input => {
            input.classList.remove("border-red-500", "border-green-500");
        });

        if (result.errors) {
            submitBtn.disabled = true;

            Object.keys(result.errors).forEach(field => {
                let input = document.querySelector(`[name="${field}"]`);

                input.classList.add("border-red-500");

                let error = document.createElement("div");
                error.classList.add("error-msg", "text-red-500", "text-xs", "mt-1");
                error.innerHTML = result.errors[field][0];

                input.insertAdjacentElement("afterend", error);
            });
        } else {
            submitBtn.disabled = false;

            inputs.forEach(input => {
                if (input.value.trim().length > 0) {
                    input.classList.add("border-green-500");

                    let ok = document.createElement("div");
                    ok.classList.add("success-msg", "text-green-600", "text-xs", "mt-1");
                    ok.innerHTML = " Data valid";
                    input.insertAdjacentElement("afterend", ok);
                }
            });
        }

        loadingText.classList.add("hidden");
    }
</script>




</html>
