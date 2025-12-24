<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <link rel="icon" href="{{ asset('images/logohitam.png') }}" type="image/x-icon">
  <title>Login - Jamila Bakery</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@700&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background-color: #f0f4f4;
    }
    .brand-font {
      font-family: 'Fraunces', serif;
    }
    .input-field {
      background-color: #f8fafc;
      transition: all 0.2s ease;
    }
    .input-field:focus {
      background-color: #ffffff;
      box-shadow: 0 0 0 2px rgba(74, 55, 40, 0.1);
    }
    .error-message {
      animation: slideDown 0.3s ease-out;
    }
    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

  <div class="max-w-4xl w-full bg-white rounded-[2.5rem] shadow-2xl overflow-hidden grid md:grid-cols-2">
    
    <!-- Left Side - Branding -->
    <div class="bg-[#fdf2f0] p-12 flex flex-col items-center justify-center text-center">
      <div class="mb-6 relative">
        <div class="text-6xl">🧁</div>
        <div class="absolute -top-2 -right-2 text-yellow-500 animate-pulse text-xl">✨</div>
      </div>
      
      <h2 class="text-2xl font-bold text-[#4a3728] mb-3">Freshly Baked Happiness</h2>
      <p class="text-gray-500 text-sm leading-relaxed mb-10 max-w-[250px]">
        Temukan kelezatan roti terbaik yang dibuat dengan cinta setiap harinya.
      </p>
      
      <h1 class="brand-font text-4xl text-[#7c5639]">jamila bakery</h1>
    </div>

    <!-- Right Side - Login Form -->
    <div class="p-10 md:p-16 flex flex-col justify-center">
      <div class="mb-10 text-center md:text-left">
        <h2 class="text-3xl font-bold text-gray-800 flex items-center justify-center md:justify-start gap-2">
          Selamat Datang <span class="text-2xl">👋</span>
        </h2>
        <p class="text-gray-400 mt-1">Silakan masuk ke akun Jamila Bakery Anda</p>
      </div>

      <!-- Success Message (jika ada) -->
      @if(session('success'))
      <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-2xl error-message">
        <div class="flex items-center gap-2">
          <i data-lucide="check-circle" class="w-5 h-5"></i>
          <span>{{ session('success') }}</span>
        </div>
      </div>
      @endif

      <!-- Error Messages -->
      @if($errors->any())
      <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-2xl error-message">
        <div class="flex items-start gap-2">
          <i data-lucide="alert-circle" class="w-5 h-5 mt-0.5"></i>
          <div class="flex-1">
            @foreach($errors->all() as $error)
              <p class="text-sm">{{ $error }}</p>
            @endforeach
          </div>
        </div>
      </div>
      @endif

      <!-- Login Form -->
      <form class="space-y-6" method="POST" action="{{ route('login.post') }}">
        @csrf
        
        <!-- Email Field -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
          <div class="relative group">
            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within:text-[#7c5639]">
              <i data-lucide="mail" class="w-5 h-5"></i>
            </span>
            <input 
              type="email" 
              name="email"
              value="{{ old('email') }}"
              placeholder="nama@email.com"
              required
              autofocus
              class="input-field w-full pl-12 pr-4 py-3 border {{ $errors->has('email') ? 'border-red-300' : 'border-gray-200' }} rounded-2xl outline-none text-sm"
            />
          </div>
        </div>

        <!-- Password Field -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
          <div class="relative group">
            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within:text-[#7c5639]">
              <i data-lucide="lock" class="w-5 h-5"></i>
            </span>
            <input 
              id="password"
              type="password" 
              name="password"
              placeholder="••••••••"
              required
              class="input-field w-full pl-12 pr-12 py-3 border {{ $errors->has('password') ? 'border-red-300' : 'border-gray-200' }} rounded-2xl outline-none text-sm"
            />
            <button type="button" onclick="togglePass()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600">
              <i data-lucide="eye-off" id="eyeIcon" class="w-5 h-5"></i>
            </button>
          </div>
        </div>

        <!-- Remember & Forgot Password -->
        <div class="flex items-center justify-between text-sm">
          <label class="flex items-center gap-2 cursor-pointer group">
            <input 
              type="checkbox" 
              name="remember" 
              class="w-4 h-4 rounded border-gray-300 text-[#4a3728] focus:ring-[#4a3728]"
            >
            <span class="text-gray-500 group-hover:text-gray-700 transition-colors">Ingat saya</span>
          </label>
          <a href="#" class="text-[#c27a5d] font-semibold hover:underline">Lupa Password?</a>
        </div>

        <!-- Submit Button -->
        <button 
          type="submit"
          class="w-full bg-[#4a3728] text-white font-bold py-4 rounded-2xl hover:bg-[#3d2d21] shadow-lg shadow-gray-200 transition-all active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed"
          id="submitBtn"
        >
          <span id="btnText">Masuk Sekarang</span>
          <span id="btnLoading" class="hidden">
            <svg class="animate-spin inline-block w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Memproses...
          </span>
        </button>

        <!-- Register Link -->
        <p class="text-center text-sm text-gray-400">
        Belum punya akun? <a href="{{ route('register') }}" class="text-[#c27a5d] font-bold hover:underline">Daftar Gratis</a>
      </p>
      </form>
    </div>
  </div>

  <script>
    // Inisialisasi Lucide Icons
    lucide.createIcons();

    // Fungsi Toggle Password
    function togglePass() {
      const passInput = document.getElementById('password');
      const eyeIcon = document.getElementById('eyeIcon');
      
      if (passInput.type === 'password') {
        passInput.type = 'text';
        eyeIcon.setAttribute('data-lucide', 'eye');
      } else {
        passInput.type = 'password';
        eyeIcon.setAttribute('data-lucide', 'eye-off');
      }
      lucide.createIcons(); // Refresh icons
    }

    // Loading state saat submit
    document.querySelector('form').addEventListener('submit', function() {
      const submitBtn = document.getElementById('submitBtn');
      const btnText = document.getElementById('btnText');
      const btnLoading = document.getElementById('btnLoading');
      
      submitBtn.disabled = true;
      btnText.classList.add('hidden');
      btnLoading.classList.remove('hidden');
    });

    // Auto dismiss success/error messages after 5 seconds
    setTimeout(function() {
      const alerts = document.querySelectorAll('.error-message');
      alerts.forEach(function(alert) {
        alert.style.transition = 'opacity 0.5s ease-out';
        alert.style.opacity = '0';
        setTimeout(function() {
          alert.remove();
        }, 500);
      });
    }, 5000);
  </script>
</body>
</html>