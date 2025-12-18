<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Login - Jamila Bakery
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
      font-family: 'Inter', sans-serif;
    }
  </style>
 </head>
 <body class="bg-[#d0f0f0] min-h-screen flex items-center justify-center p-4">
  <div class="relative bg-white rounded-xl shadow-lg max-w-5xl w-full flex flex-col md:flex-row items-center md:items-start p-8 md:p-12">
   <!-- Abstract shapes behind -->
   <img alt="Abstract turquoise shape behind the card top left" class="hidden md:block absolute top-0 left-0 -z-10 w-[600px] h-[400px] rounded-full opacity-70" height="400" src="https://storage.googleapis.com/a1aa/image/b411bd7b-0cf7-4920-16e0-24c48af40dc8.jpg" style="clip-path: ellipse(50% 70% at 30% 30%)" width="600"/>
   <img alt="Abstract green shape behind the card bottom right" class="hidden md:block absolute bottom-0 right-0 -z-10 w-[600px] h-[400px] rounded-full opacity-70" height="400" src="https://storage.googleapis.com/a1aa/image/50b3e803-ff11-4a92-33b8-453aca23df06.jpg" style="clip-path: ellipse(50% 70% at 70% 70%)" width="600"/>
   <!-- Left illustration -->
   <div class="md:w-1/2 flex justify-center md:justify-start mb-8 md:mb-0">
    <img alt="Illustration of a man with a briefcase talking to a woman behind a reception desk with a plant" class="w-[320px] h-auto" height="300" src="https://storage.googleapis.com/a1aa/image/5435d83d-c172-414e-d58c-2479a2aff0f8.jpg" width="400"/>
   </div>
   <!-- Right form -->
   <div class="md:w-1/2 max-w-md">
    <h1 class="text-[#1a1a1a] text-2xl font-normal mb-2">
     Welcome Back :)
    </h1>
    <p class="text-[#4a4a4a] text-xs mb-6 leading-tight">
     To keep connected with us please login with your personal information by email address and password
     <span class="inline-block align-middle text-lg">
      🔔
     </span>
    </p>
    <form class="space-y-4" onsubmit="return false;">
     <!-- Email input -->
     <label class="block text-xs text-[#4a4a4a] mb-1 flex items-center gap-2" for="email">
      <i class="far fa-envelope text-[#4a4a4a]">
      </i>
      Email Address
     </label>
     <input class="w-full text-xs text-[#4a4a4a] bg-[#f3f7fc] border border-[#d1d5db] rounded-md py-2 px-3 pr-10 focus:outline-none focus:ring-1 focus:ring-blue-600" id="email" type="email" value=""/>
     <span aria-hidden="true" class="absolute right-3 top-[calc(100%_-_2.5rem)] text-green-600 text-lg hidden">
      <i class="fas fa-check-circle">
      </i>
     </span>
     <!-- Password input -->
     <label class="block text-xs text-[#4a4a4a] mb-1 flex items-center gap-2" for="password">
      <i class="fas fa-lock text-[#4a4a4a]">
      </i>
      Password
     </label>
     <div class="relative">
      <input class="w-full text-xs text-[#4a4a4a] bg-[#f3f7fc] border border-[#d1d5db] rounded-md py-2 px-3 pr-10 focus:outline-none focus:ring-1 focus:ring-blue-600" id="password" type="password" value=""/>
      <button aria-label="Toggle password visibility" class="absolute right-2 top-1/2 -translate-y-1/2 text-[#4a4a4a] hover:text-blue-600 focus:outline-none" id="togglePassword" type="button">
       <i class="fas fa-eye">
       </i>
      </button>
     </div>
     <div class="flex justify-between items-center text-xs text-[#4a4a4a] mt-1">
      <label class="flex items-center gap-2">
       <input checked="" class="w-4 h-4 text-green-600 border border-gray-300 rounded focus:ring-green-500 focus:ring-2" type="checkbox"/>
       <span class="text-green-600 font-semibold">
        Remember Me
       </span>
      </label>
      <button class="text-[#4a4a4a] hover:underline focus:outline-none" type="button">
       Forget Password?
      </button>
     </div>
     <div class="flex gap-4 mt-6">
      <button class="bg-blue-600 text-white text-xs font-semibold rounded-full px-6 py-2 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 flex-1" type="submit">
       Login Now
      </button>
     </div>
    </form>
   </div>
   <!-- Logo top left -->
   <div class="absolute top-6 left-6 flex items-center gap-2">
    <img alt="Jamila Bakery logo icon blue" class="w-6 h-6" height="24" src="https://storage.googleapis.com/a1aa/image/2fee115c-7757-446e-2c2c-1dc1c6ed0ad8.jpg" width="24"/>
    <span class="text-[#2563eb] font-semibold text-sm select-none">
     jamila bakery
    </span>
   </div>
  </div>
  <script>
   const togglePassword = document.getElementById('togglePassword');
   const passwordInput = document.getElementById('password');

   togglePassword.addEventListener('click', () => {
     if (passwordInput.type === 'password') {
       passwordInput.type = 'text';
       togglePassword.innerHTML = '<i class="fas fa-eye-slash"></i>';
     } else {
       passwordInput.type = 'password';
       togglePassword.innerHTML = '<i class="fas fa-eye"></i>';
     }
   });
  </script>
 </body>
</html>