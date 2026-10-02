<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Smart Library - Masuk</title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "secondary-fixed": "#d8e3fb", "tertiary-container": "#007d55",
                        "error": "#ba1a1a", "on-error-container": "#93000a",
                        "primary": "#004ac6", "surface-container-highest": "#d3e4fe",
                        "secondary-container": "#d5e0f8", "outline": "#737686",
                        "on-secondary": "#ffffff", "background": "#f8f9ff",
                        "surface-container-low": "#eff4ff", "on-surface-variant": "#434655",
                        "on-surface": "#0b1c30", "error-container": "#ffdad6",
                        "on-primary": "#ffffff", "surface-container-high": "#dce9ff",
                        "surface-variant": "#d3e4fe", "surface-dim": "#cbdbf5",
                        "primary-container": "#2563eb", "secondary": "#545f73",
                        "inverse-surface": "#213145", "tertiary": "#006242",
                        "on-tertiary": "#ffffff", "surface-bright": "#f8f9ff",
                        "on-error": "#ffffff", "surface-tint": "#0053db",
                        "surface-container": "#e5eeff", "outline-variant": "#c3c6d7",
                        "tertiary-fixed": "#6ffbbe", "on-primary-container": "#eeefff",
                        "surface-container-lowest": "#ffffff"
                    },
                    borderRadius: { DEFAULT: "0.25rem", lg: "0.5rem", xl: "0.75rem", full: "9999px" },
                    spacing: {
                        "margin-tablet": "1.5rem", gutter: "1rem", margin: "1rem",
                        "space-md": "0.75rem", "space-xl": "1.5rem", "space-xs": "0.25rem",
                        "gutter-sm": "0.75rem", "space-lg": "1rem", "space-sm": "0.5rem"
                    },
                    fontFamily: {
                        "headline-lg": ["Plus Jakarta Sans"], "headline-sm": ["Plus Jakarta Sans"],
                        "label-lg": ["Plus Jakarta Sans"], "headline-md": ["Plus Jakarta Sans"],
                        "body-lg": ["Plus Jakarta Sans"], "label-md": ["Plus Jakarta Sans"],
                        "label-sm": ["Plus Jakarta Sans"], "body-sm": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"]
                    },
                    fontSize: {
                        "headline-lg": ["30px", { lineHeight: "38px", fontWeight: "700" }],
                        "headline-sm": ["16px", { lineHeight: "24px", fontWeight: "600" }],
                        "label-lg": ["14px", { lineHeight: "20px", fontWeight: "600" }],
                        "headline-md": ["20px", { lineHeight: "28px", fontWeight: "700" }],
                        "body-lg": ["16px", { lineHeight: "24px", fontWeight: "400" }],
                        "label-md": ["12px", { lineHeight: "16px", fontWeight: "600" }],
                        "label-sm": ["11px", { lineHeight: "14px", letterSpacing: "0.02em", fontWeight: "700" }],
                        "body-sm": ["12px", { lineHeight: "18px", fontWeight: "400" }],
                        "body-md": ["14px", { lineHeight: "20px", fontWeight: "400" }]
                    }
                }
            }
        };
    </script>
</head>
<body class="bg-surface font-body-md text-body-md text-on-surface antialiased min-h-screen">
<main class="w-full min-h-screen bg-surface flex flex-col justify-center items-center px-margin md:px-margin-tablet">
    <div class="flex flex-col w-full items-center justify-center py-space-xl relative">
        <div class="absolute -top-12 -left-12 w-96 h-96 bg-primary-fixed/25 rounded-full blur-3xl pointer-events-none -z-10"></div>
        <div class="absolute -bottom-16 -right-16 w-80 h-80 bg-surface-container-highest/60 rounded-full blur-2xl pointer-events-none -z-10"></div>

        <div class="w-full max-w-[450px] bg-surface-container-lowest rounded-xl shadow-xl p-8 sm:p-10 transition-all">
            <div class="flex flex-col items-center text-center">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-12 h-12 rounded-xl bg-primary-container text-on-primary flex items-center justify-center shadow-md shadow-primary-container/20">
                        <span class="material-symbols-outlined text-[28px]" style="font-variation-settings: 'FILL' 1;">menu_book</span>
                    </div>
                    <div class="flex flex-col text-left">
                        <div class="flex items-center font-headline-md text-headline-md tracking-tight">
                            <span class="text-on-surface">Smart</span>
                            <span class="text-primary-container">Library</span>
                        </div>
                        <span class="font-label-sm text-label-sm uppercase tracking-widest text-secondary -mt-0.5">Perpustakaan Digital</span>
                    </div>
                </div>
                <h1 class="font-headline-md text-headline-md text-on-surface mt-6 mb-1.5">Masuk untuk melanjutkan</h1>
                <p class="font-body-sm text-body-sm text-secondary leading-relaxed max-w-[340px]">
                    Silakan masukkan kredensial akun siswa, mahasiswa, atau pustakawan Anda.
                </p>
            </div>

            {{-- Alert sukses setelah logout --}}
            @if (session('success'))
                <div class="mt-4 p-3 rounded-lg bg-emerald-50 text-emerald-700 text-body-sm text-center">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Alert error umum --}}
            @if ($errors->any() && !$errors->has('email'))
                <div class="mt-4 p-3 rounded-lg bg-error-container text-on-error-container text-body-sm text-center">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="mt-8 flex flex-col gap-space-lg" id="authForm">
                @csrf

                <div class="flex flex-col gap-1.5">
                    <label class="font-label-lg text-label-lg text-on-surface flex items-center gap-1" for="email">
                        <span>Email</span>
                        <span class="text-error font-body-sm">*</span>
                    </label>
                    <div class="relative flex items-center">
                        <span class="material-symbols-outlined absolute left-3.5 text-on-surface-variant pointer-events-none text-[20px]">mail</span>
                        <input name="email" id="email" value="{{ old('email') }}" 
                               class="w-full h-11 pl-11 pr-4 bg-surface-container-low text-on-surface font-body-md text-body-md rounded-lg outline-none focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container transition-all @error('email') ring-2 ring-error @enderror" 
                               placeholder="contoh: 12345678@sekolah.id" required type="email" autofocus />
                    </div>
                    @error('email')
                        <p class="text-error text-body-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1.5">
                    <label class="font-label-lg text-label-lg text-on-surface flex items-center gap-1" for="password">
                        <span>Password / Kata Sandi</span>
                        <span class="text-error font-body-sm">*</span>
                    </label>
                    <div class="relative flex items-center">
                        <span class="material-symbols-outlined absolute left-3.5 text-on-surface-variant pointer-events-none text-[20px]">lock</span>
                        <input name="password" id="password" 
                               class="w-full h-11 pl-11 pr-11 bg-surface-container-low text-on-surface font-body-md text-body-md rounded-lg outline-none focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container transition-all" 
                               placeholder="Masukkan kata sandi" required type="password" />
                        <button aria-label="Tampilkan atau sembunyikan kata sandi" 
                                class="absolute right-2.5 w-8 h-8 flex items-center justify-center rounded-full text-on-surface-variant hover:bg-surface-container hover:text-on-surface transition-colors" 
                                id="togglePasswordBtn" onclick="togglePasswordVisibility()" type="button">
                            <span class="material-symbols-outlined text-[20px]" id="passwordEyeIcon">visibility</span>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-0.5">
                    <label class="flex items-center gap-2 cursor-pointer select-none group">
                        <input name="remember" class="w-4 h-4 rounded text-primary-container focus:ring-primary-container accent-primary-container cursor-pointer" 
                               id="rememberMe" type="checkbox" {{ old('remember') ? 'checked' : '' }} />
                        <span class="font-body-sm text-body-sm text-secondary group-hover:text-on-surface transition-colors">Ingat saya</span>
                    </label>
                    <a class="font-label-md text-label-md text-primary-container hover:text-primary transition-colors" href="javascript:void(0)">Lupa password?</a>
                </div>

                <button class="w-full h-12 bg-primary-container hover:bg-primary text-on-primary font-label-lg text-label-lg rounded-lg shadow-md shadow-primary-container/25 flex items-center justify-center gap-2 transition-all active:scale-[0.98] mt-1" 
                        id="submitBtn" type="submit">
                    <span>Masuk Sekarang</span>
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </button>
            </form>

            <div class="relative flex py-5 items-center my-2">
                <div class="flex-grow bg-surface-container h-[1px]"></div>
                <span class="flex-shrink mx-3 font-label-sm text-label-sm uppercase tracking-wider text-secondary">atau masuk dengan</span>
                <div class="flex-grow bg-surface-container h-[1px]"></div>
            </div>

            <div class="flex flex-col gap-2.5">
                <button class="w-full h-11 bg-surface-container-low hover:bg-surface-container text-on-surface font-label-md text-label-md rounded-lg flex items-center justify-center gap-3 transition-colors group" type="button">
                    <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z" fill="#FBBC05"></path>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z" fill="#EA4335"></path>
                    </svg>
                    <span class="group-hover:text-primary-container transition-colors">Akun Google Institusi / Belajar.id</span>
                </button>
                <button class="w-full h-11 bg-surface-container-low hover:bg-surface-container text-on-surface font-label-md text-label-md rounded-lg flex items-center justify-center gap-2.5 transition-colors group" type="button">
                    <span class="material-symbols-outlined text-[20px] text-tertiary">account_balance</span>
                    <span class="group-hover:text-tertiary transition-colors">Portal SSO Civitas Akademika</span>
                </button>
            </div>

            <div class="mt-8 pt-4 bg-surface-container/40 -mx-8 sm:-mx-10 -mb-8 sm:-mb-10 p-4 text-center rounded-b-xl flex items-center justify-center gap-1">
                <span class="font-body-sm text-body-sm text-secondary">Belum punya akun?</span>
                <a class="font-label-md text-label-md text-primary-container hover:underline" href="{{ route('register') }}">Daftar sekarang</a>
            </div>
        </div>

        <div class="mt-6 flex flex-wrap items-center justify-center gap-2 max-w-[450px] px-2">
            <div class="inline-flex items-center gap-2 bg-surface-container-low text-on-surface-variant px-3 py-1.5 rounded-full shadow-sm">
                <span class="material-symbols-outlined text-tertiary text-[18px]">verified</span>
                <span class="font-label-sm text-label-sm">12.000+ Bahan Pustaka & Jurnal Digital Terintegrasi</span>
            </div>
        </div>

        <div class="mt-4 text-center">
            <p class="font-body-sm text-body-sm text-secondary opacity-75">© 2024 Smart Library. Perpustakaan Digital Terakreditasi Nasional.</p>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            const eyeIcon = document.getElementById('passwordEyeIcon');
            if (!passwordField || !eyeIcon) return;

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.textContent = 'visibility_off';
            } else {
                passwordField.type = 'password';
                eyeIcon.textContent = 'visibility';
            }
        }
    </script>
</main>
</body>
</html>