<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 sm:px-0 px-4 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">

        <h2 class="text-2xl font-bold text-center mb-6">Daftar Akun</h2>

        <form id="registerForm" action="{{ route('user.register.post') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 text-sm font-medium">Nama</label>
                <input type="text" name="name"
                    class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-orange-400" required>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium">Email</label>
                <input type="email" name="email"
                    class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-orange-400" required>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium">Password</label>
                <input type="password" name="password"
                    class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-orange-400" required>
            </div>

            <button type="submit" id="submitBtn"
                class="w-full bg-orange-500 text-white py-2 rounded-lg hover:bg-orange-600 transition">
                Daftar
            </button>
        </form>
        <span id="loading" class="hidden ml-2 text-sm">Validasi...</span>

        <div class="text-center mt-6 text-sm text-gray-600">
            Sudah punya akun?
            <a href="/login" class="text-orange-500 font-semibold hover:underline">
                Login
            </a>
        </div>

    </div>

</body>
<script>
    const form = document.getElementById("registerForm");
    const inputs = document.querySelectorAll("input[name='name'], input[name='email'], input[name='password']");
    const submitBtn = document.getElementById("submitBtn");

    // Ubah tulisan loading ke bahasa Indonesia
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
                    ok.innerHTML = "✔ Data valid";
                    input.insertAdjacentElement("afterend", ok);
                }
            });
        }

        loadingText.classList.add("hidden");
    }
</script>




</html>
