{{-- resources/views/home.blade.php --}}
<x-layout.app title="The Grand Wizarding Conquest">

  <style>
      @keyframes float-magic {
          0% { transform: translateY(0px) rotate(0deg); }
          50% { transform: translateY(-15px) rotate(-3deg); }
          100% { transform: translateY(0px) rotate(0deg); }
      }
      @keyframes float-magic-alt {
          0% { transform: translateY(0px) rotate(0deg); }
          50% { transform: translateY(-10px) rotate(4deg); }
          100% { transform: translateY(0px) rotate(0deg); }
      }
      .animate-float-magic { animation: float-magic 4s ease-in-out infinite; }
      .animate-float-magic-alt { animation: float-magic-alt 5s ease-in-out infinite; }
  </style>

  {{-- HERO SECTION --}}
  <section x-data="{ showNote: false, showArena: false }" class="min-h-[calc(100vh-5rem)] flex flex-col items-center justify-center text-center px-6 overflow-hidden relative bg-slate-900">

    {{-- Latar Belakang --}}
    <div class="absolute inset-0 z-0 pointer-events-none select-none"
         style="-webkit-mask-image: linear-gradient(to top, transparent 0%, black 15%); mask-image: linear-gradient(to top, transparent 0%, black 15%);">
        <img src="{{ asset('backgrounds/background-home-desktop.jpg') }}"
             class="w-full h-full object-cover object-bottom opacity-90"
             alt="Magic Library Background">
    </div>

    <x-home.background-stars />

    {{-- Konten Utama (Maskot & Elemen Interaktif) --}}
    <div class="max-w-5xl mx-auto w-full flex flex-col items-center justify-center animate-reveal relative z-10">
        <x-home.floating-items />
    </div>

    

    {{-- Modal Pop-up (Teleportasi otomatis ke Body) --}}
    <x-home.modal-note />
    <x-home.modal-arena />

  </section>

</x-layout.app>