<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8"/><meta content="width=device-width, initial-scale=1" name="viewport"/>
  <link rel="icon" href="{{ asset('images/logohitam.png') }}" type="image/x-icon">
  <title>Daftar - Jamila Bakery</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@700&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet"/>
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f0f4f4; }
    .brand-font { font-family: 'Fraunces', serif; }
    .input-field { background-color: #f8fafc; transition: all 0.2s ease; }
    .input-field:focus { background-color: #ffffff; box-shadow: 0 0 0 2px rgba(74, 55, 40, 0.1); }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
  <div class="max-w-4xl w-full bg-white rounded-[2.5rem] shadow-2xl overflow-hidden grid md:grid-cols-2">
    <div class="bg-[#fdf2f0] p-12 flex flex-col items-center justify-center text-center">
      <div class="text-6xl mb-6">🍞</div>
      <h2 class="text-2xl font-bold text-[#4a3728] mb-3">Gabung Bersama Kami</h2>
      <p class="text-gray-500 text-sm leading-relaxed mb-10 max-w-[250px]">Mulai kelola bakery Anda dengan sistem yang lebih modern.</p>
      <h1 class="brand-font text-4xl text-[#7c5639]">jamila bakery</h1>
    </div>

    <div class="p-10 md:p-16 flex flex-col justify-center">
      <div class="mb-10 text-center md:text-left">
        <h2 class="text-3xl font-bold text-gray-800">Daftar Akun</h2>
        <p class="text-gray-400 mt-1">Lengkapi data untuk membuat akun kasir</p>
      </div>

      <form class="space-y-4" method="POST" action="{{ route('register.post') }}">
        @csrf
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
          <input type="text" name="name" required class="input-field w-full px-4 py-3 border border-gray-200 rounded-2xl outline-none text-sm" placeholder="Nama Anda">
        </div>

        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
          <input type="email" name="email" required class="input-field w-full px-4 py-3 border border-gray-200 rounded-2xl outline-none text-sm" placeholder="email@contoh.com">
        </div>

        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
            <input type="password" name="password" required class="input-field w-full px-4 py-3 border border-gray-200 rounded-2xl outline-none text-sm" placeholder="••••••">
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi</label>
            <input type="password" name="password_confirmation" required class="input-field w-full px-4 py-3 border border-gray-200 rounded-2xl outline-none text-sm" placeholder="••••••">
          </div>
        </div>

        <button type="submit" class="w-full bg-[#4a3728] text-white font-bold py-4 rounded-2xl hover:bg-[#3d2d21] shadow-lg transition-all mt-6">
          Daftar Sekarang
        </button>

        <p class="text-center text-sm text-gray-400 mt-4">
          Sudah punya akun? <a href="{{ route('login') }}" class="text-[#c27a5d] font-bold hover:underline">Masuk</a>
        </p>
      </form>
    </div>
  </div>
  <script>lucide.createIcons();</script>
</body>
</html>