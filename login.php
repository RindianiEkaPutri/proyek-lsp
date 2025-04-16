<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Login</h2>

        <form action="proses_login.php" method="POST" class="space-y-4">
            <!-- Pilihan Role -->
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Login Sebagai</label>
                <select id="role" name="role" required
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="guru">Guru</option>
                    <option value="siswa">Siswa</option>
                </select>
            </div>
            <!-- TUTUP PILIH Role -->

            <!-- Nama -->
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" id="nama" name="nama" required
                       class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <!-- TUTUP NAMA -->

            <!-- NIP / NIS (Password) -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" required
                       class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <!-- Tutup NIP / (Password) -->

            <div class="pt-4">
                <button type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg transition duration-200">
                    Login
                </button>
            </div>
        </form>

        <p class="text-center text-sm text-gray-600 mt-4">
            <a href="register.php" class="text-blue-500 hover:underline">Belum Punya Akun? Daftar</a>
        </p>
    </div>

</body>
</html>
