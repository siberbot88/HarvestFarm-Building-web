<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HarvestFarm - Langsung dari Kebun</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Tambahkan konfigurasi custom color -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'custom-green': '#1F5233',
            'custom-green-dark': '#174026'
          }
        }
      }
    }
  </script>
</head>
<body class="font-sans bg-white text-gray-800">

  <!-- Navbar -->
  <nav class="flex items-center justify-between px-8 py-4 shadow">
    <div class="flex items-center gap-2">
      <img src="./images/logo2.png" alt="HarvestFarm" class="w-8 h-8">
      <span class="text-xl font-bold text-green-800">HarvestFarm</span>
    </div>
    <div class="flex items-center gap-6">
      <a href="#" class="flex items-center gap-2 text-sm font-semibold text-green-800">
        <img src="./images/kategori.png" alt="Kategori" class="w-5 h-5">Kategori
      </a>
      <input type="text" placeholder="Bantu saya mencari ..." 
             class="px-4 py-2 rounded-full border border-gray-300 w-64 focus:outline-none focus:ring-2 focus:ring-green-800">
      <button class="p-2 hover:bg-gray-100 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.4 5H19m-7 0a2 2 0 100 4 2 2 0 000-4z" />
        </svg>
      </button>
      <button class="bg-green-800 hover:bg-green-900 text-white px-4 py-2 rounded-full text-sm transition-colors">
        Daftar
      </button>
      <button class="bg-lime-500 hover:bg-lime-600 text-white px-4 py-2 rounded-full text-sm transition-colors">
        Masuk
      </button>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="mt-[133px] mb-[291px] mx-[140px]">
    <div class="relative w-full max-w-[1160px] h-[600px] mx-auto overflow-hidden rounded-3xl">
      <!-- Image Container dengan Constraint -->
      <div class="relative h-full w-full">
        <img src="./images/iklan.png" alt="Iklan" 
             class="w-full h-full object-cover object-center" 
             style="max-width: 1035px; max-height: 430.5px" >
      
      <!-- Tombol CTA -->
      <div class="absolute left-[65px] bottom-[100px] z-10">
        <button class="bg-custom-green hover:bg-custom-green-dark text-white text-lg font-semibold px-8 py-4 rounded-full 
                   transition-all duration-300 transform hover:scale-105 shadow-lg">
          Mulai Berbelanja
        </button>
      </div>

      <!-- Slider Indicator -->
      <div class="absolute bottom-5 left-0 right-0 flex justify-center items-center gap-3">
        <button class="bg-lime-500 hover:bg-lime-600 text-white p-2 rounded-full transition-colors shadow-md">&lt;</button>
        <span class="h-2 w-2 bg-green-900 rounded-full"></span>
        <span class="h-2 w-2 bg-green-500 rounded-full"></span>
        <span class="h-2 w-2 bg-green-500 rounded-full"></span>
        <span class="h-2 w-2 bg-green-500 rounded-full"></span>
        <button class="bg-green-900 hover:bg-green-950 text-white p-2 rounded-full transition-colors shadow-md">&gt;</button>
      </div>
    </div>
  </section>

</body>
</html>