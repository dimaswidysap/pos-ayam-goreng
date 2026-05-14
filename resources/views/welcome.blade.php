<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ayam Goreng Widy</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,700&family=Lora:ital,wght@0,400;0,500;1,400&family=DM+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- Vite assets --}}
    @vite(['resources/css/app.css', 'resources/css/landingPage.css', 'resources/js/landingPage.js'])
</head>

<body class="antialiased">

    {{-- ======================================================
         NAVBAR
    ====================================================== --}}
    <nav id="navbar" class="navbar">
        <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">

            {{-- Brand --}}
            <a href="/" class="navbar-brand">
                Ayam Goreng <span>Widy</span>
            </a>

            {{-- Actions --}}
            <div class="flex items-center gap-3">
                {{-- Kasir: route belum dibuat, kosong dulu --}}
                <a href="{{ route('kasir') }}" class="btn-kasir">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="3" width="20" height="14" rx="2" />
                        <path d="M8 21h8M12 17v4" />
                    </svg>
                    Kasir
                </a>

                {{-- Admin --}}
                <a href="{{ route('index') }}" class="btn-admin">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2a5 5 0 1 0 5 5A5 5 0 0 0 12 2z" />
                        <path d="M20 21v-1a7 7 0 0 0-14 0v1" />
                    </svg>
                    Admin
                </a>
            </div>

        </div>
    </nav>


    {{-- ======================================================
         HERO — 100vh
    ====================================================== --}}
    <section class="hero-section">
        <div class="max-w-6xl mx-auto px-6 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-6 items-center min-h-screen py-24">

                {{-- ── Kiri: Vektor Ayam Goreng ─────────────────────────── --}}
                <div class="flex justify-center lg:justify-start order-2 lg:order-1">
                    <div class="relative">
                        {{-- Lingkaran dekoratif di belakang --}}
                        <div class="absolute inset-0 -m-8 rounded-full opacity-40"
                            style="background: radial-gradient(circle, rgba(212,168,75,0.18) 0%, transparent 70%);">
                        </div>

                        {{-- SVG Ayam Goreng --}}
                        <div class="animate-float relative z-10 animate-fade-in delay-200">
                            <svg viewBox="0 0 420 420" xmlns="http://www.w3.org/2000/svg"
                                class="w-72 h-72 sm:w-80 sm:h-80 lg:w-96 lg:h-96 drop-shadow-2xl"
                                aria-label="Ilustrasi Ayam Goreng">

                                {{-- Piring / wadah --}}
                                <ellipse cx="210" cy="345" rx="145" ry="22" fill="#E8E0D0"
                                    opacity="0.6" />
                                <ellipse cx="210" cy="340" rx="138" ry="18" fill="#F0E8D8"
                                    opacity="0.9" />

                                {{-- Bayangan paha bawah --}}
                                <ellipse cx="210" cy="300" rx="95" ry="15" fill="#C8A070"
                                    opacity="0.25" />

                                {{-- ── Paha / Drumstick utama ──────────────── --}}
                                {{-- Tulang / stick --}}
                                <rect x="196" y="290" width="28" height="70" rx="14" fill="#F5E8D0" />
                                <ellipse cx="210" cy="358" rx="18" ry="11" fill="#EDD8B0" />

                                {{-- Daging paha — lapisan bawah (bayangan) --}}
                                <ellipse cx="210" cy="235" rx="80" ry="72" fill="#C47830"
                                    opacity="0.35" />

                                {{-- Daging paha — badan utama --}}
                                <ellipse cx="210" cy="230" rx="78" ry="70" fill="#D4863C" />

                                {{-- Kulit goreng — tekstur keemasan --}}
                                <ellipse cx="210" cy="222" rx="75" ry="66" fill="#E8963A" />

                                {{-- Highlight bagian atas (cahaya) --}}
                                <ellipse cx="195" cy="192" rx="42" ry="30" fill="#F0A848"
                                    opacity="0.7" />
                                <ellipse cx="188" cy="185" rx="22" ry="14" fill="#F8C060"
                                    opacity="0.5" />

                                {{-- Tekstur renyah / bumbu goreng --}}
                                <circle cx="175" cy="210" r="9" fill="#C07028" opacity="0.5" />
                                <circle cx="240" cy="225" r="7" fill="#B86820" opacity="0.45" />
                                <circle cx="195" cy="250" r="8" fill="#C87830" opacity="0.4" />
                                <circle cx="228" cy="205" r="6" fill="#D08038" opacity="0.5" />
                                <circle cx="168" cy="238" r="5" fill="#B86020" opacity="0.4" />
                                <circle cx="250" cy="248" r="6" fill="#C07028" opacity="0.4" />

                                {{-- Tonjolan bagian atas (sendi tulang atas) --}}
                                <ellipse cx="210" cy="162" rx="32" ry="26"
                                    fill="#D4863C" />
                                <ellipse cx="210" cy="158" rx="28" ry="22"
                                    fill="#E8963A" />
                                <ellipse cx="204" cy="152" rx="14" ry="10" fill="#F0A848"
                                    opacity="0.6" />

                                {{-- ── Paha kecil (latar belakang) ──────────── --}}
                                <ellipse cx="285" cy="248" rx="48" ry="58" fill="#C87830"
                                    opacity="0.5" />
                                <ellipse cx="282" cy="244" rx="44" ry="54"
                                    fill="#D48038" />
                                <ellipse cx="282" cy="240" rx="42" ry="50"
                                    fill="#E08A3C" />
                                <ellipse cx="275" cy="222" rx="24" ry="18" fill="#EDA050"
                                    opacity="0.6" />
                                {{-- Tulang kecil --}}
                                <rect x="274" y="290" width="18" height="52" rx="9" fill="#F0E0C0" />

                                {{-- ── Sayap (kiri latar) ───────────────────── --}}
                                <ellipse cx="138" cy="252" rx="42" ry="52" fill="#C87828"
                                    opacity="0.45" />
                                <ellipse cx="140" cy="248" rx="38" ry="48" fill="#D48038"
                                    opacity="0.7" />
                                <ellipse cx="140" cy="244" rx="36" ry="44"
                                    fill="#E08A40" />
                                <ellipse cx="133" cy="228" rx="20" ry="16" fill="#EDA050"
                                    opacity="0.5" />

                                {{-- ── Hiasan: daun peterseli ───────────────── --}}
                                <ellipse cx="158" cy="310" rx="16" ry="10" fill="#6A9B58"
                                    transform="rotate(-25 158 310)" />
                                <ellipse cx="148" cy="316" rx="13" ry="8" fill="#5C8A48"
                                    transform="rotate(-40 148 316)" />
                                <ellipse cx="168" cy="316" rx="11" ry="7" fill="#7AAD65"
                                    transform="rotate(-10 168 316)" />

                                {{-- Peterseli kanan --}}
                                <ellipse cx="262" cy="312" rx="14" ry="9" fill="#6A9B58"
                                    transform="rotate(20 262 312)" />
                                <ellipse cx="272" cy="318" rx="12" ry="7" fill="#5C8A48"
                                    transform="rotate(35 272 318)" />

                                {{-- ── Uap / steam ─────────────────────────── --}}
                                <path d="M185 135 Q190 120 185 108 Q180 96 185 84" fill="none" stroke="#D4C0A0"
                                    stroke-width="3" stroke-linecap="round" opacity="0.4" />
                                <path d="M210 128 Q216 112 210 98 Q204 84 210 70" fill="none" stroke="#D4C0A0"
                                    stroke-width="3" stroke-linecap="round" opacity="0.35" />
                                <path d="M234 132 Q240 116 234 104 Q228 92 234 80" fill="none" stroke="#D4C0A0"
                                    stroke-width="3" stroke-linecap="round" opacity="0.3" />

                                {{-- Glow bawah --}}
                                <ellipse cx="210" cy="340" rx="100" ry="12" fill="#C8A070"
                                    opacity="0.15" />
                            </svg>
                        </div>

                        {{-- Label kecil mengambang --}}
                        <div class="absolute -bottom-2 right-4 lg:right-0 hero-badge animate-fade-up delay-500">
                            <span class="dot"></span>
                            Tersedia Setiap Hari
                        </div>
                    </div>
                </div>


                {{-- ── Kanan: Text & CTA ────────────────────────────────── --}}
                <div class="order-1 lg:order-2 flex flex-col gap-5">

                    <p class="hero-tagline animate-fade-up delay-100">
                        ✦ Warung Makan Keluarga
                    </p>

                    <h1 class="hero-title animate-fade-up delay-200">
                        Ayam Goreng<br>
                        <span class="highlight">Widy</span>
                    </h1>

                    <div class="divider-ornament animate-fade-up delay-300">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2l2.4 7.4H22l-6.2 4.5 2.4 7.4L12 17l-6.2 4.3 2.4-7.4L2 9.4h7.6z" />
                        </svg>
                    </div>

                    <p class="hero-subtitle animate-fade-up delay-400">
                        Ayam goreng renyah dengan bumbu rempah pilihan,
                        dimasak segar setiap hari untuk keluarga Anda.
                        Cita rasa rumahan yang selalu bikin rindu.
                    </p>

                    {{-- <div class="flex flex-wrap gap-3 pt-2 animate-fade-up delay-500">
                        <a href="#" class="btn-hero-primary">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z" />
                                <line x1="3" y1="6" x2="21" y2="6" />
                                <path d="M16 10a4 4 0 0 1-8 0" />
                            </svg>
                            Lihat Menu
                        </a>
                        <a href="#" class="btn-hero-secondary">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.15 12 19.79 19.79 0 0 1 1.08 3.38 2 2 0 0 1 3.05 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.09 8.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21 16z" />
                            </svg>
                            Hubungi Kami
                        </a>
                    </div> --}}

                    {{-- Info singkat --}}
                    <div class="flex flex-wrap gap-4 pt-3 animate-fade-up delay-600">
                        <div class="flex items-center gap-2 text-sm"
                            style="color: var(--color-text-muted); font-family: 'DM Sans', sans-serif;">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" style="color: var(--color-primary);">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                            Buka 08.00 – 21.00
                        </div>
                        <div class="flex items-center gap-2 text-sm"
                            style="color: var(--color-text-muted); font-family: 'DM Sans', sans-serif;">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" style="color: var(--color-primary);">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                            Madiun, Jawa Timur
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- Scroll indicator --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1 animate-fade-in delay-600"
            style="color: var(--color-text-light);">
            <span
                style="font-family: 'DM Sans', sans-serif; font-size: 0.7rem; letter-spacing: 0.1em; text-transform: uppercase;">Scroll</span>
            <svg width="16" height="20" viewBox="0 0 16 24" fill="none" stroke="currentColor"
                stroke-width="1.5">
                <rect x="1" y="1" width="14" height="22" rx="7" />
                <circle cx="8" cy="7" r="2" fill="currentColor" stroke="none">
                    <animate attributeName="cy" values="7;15;7" dur="1.8s" repeatCount="indefinite" />
                    <animate attributeName="opacity" values="1;0;1" dur="1.8s" repeatCount="indefinite" />
                </circle>
            </svg>
        </div>
    </section>


    {{-- ======================================================
         FOOTER
    ====================================================== --}}
    <footer class="site-footer">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                <div class="footer-brand">
                    Ayam Goreng <span>Widy</span>
                </div>
                <p class="footer-text text-center">
                    Warung Makan Keluarga · Madiun, Jawa Timur
                </p>
            </div>
            <hr class="footer-divider">
            <p class="footer-text text-center">
                &copy; <span id="footer-year"></span> Ayam Goreng Widy. Hak Cipta Dilindungi.
            </p>
        </div>
    </footer>

</body>

</html>
