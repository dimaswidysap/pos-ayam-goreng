<!doctype html>
<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css'])
</head>

<body>
    {{-- Modal Konfirmasi --}}
<section id="confirm-modal" class="alert-universal-delete fixed h-screen w-full inset-0 backdrop-blur-sm z-100 hidden items-center justify-center">
  <div class="bg-base border border-border rounded-xl shadow-lg w-11/12 max-w-sm p-6 text-center">
    <p id="confirm-message" class="text-slate-800 font-montserrat font-black mb-6"></p>
    <div class="flex justify-center gap-3">
      <button id="confirm-cancel" type="button"
        class="px-4 py-2 font-montserrat rounded-md border border-border-dark text-text-muted hover:bg-surface-alt transition">
        Batal
      </button>
      <button id="confirm-ok" type="button"
        class="px-4 py-2 font-montserrat rounded-md bg-primary text-white hover:bg-primary-dark transition">
        Ya, Hapus
      </button>
    </div>
  </div>
</section>

{{-- Toast Notifikasi --}}
<div id="toast-alert" class="fixed bg-red-700 top-5  right-5 z-110 hidden px-4 py-3 rounded-md shadow-lg text-sm text-white max-w-sm">
  <span id="toast-message" class="font-montserrat font-black"></span>
</div>
    <main class="w-full max-w-7xl m-auto font-montserrat relative ">
        @yield('konten')
    </main>
</body>

</html>
