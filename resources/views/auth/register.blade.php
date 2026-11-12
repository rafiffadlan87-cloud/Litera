<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Smart Library - Registrasi</title>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500..700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-surface font-body-md text-body-md text-on-surface antialiased min-h-screen">
    <main
        class="w-full min-h-screen bg-surface flex flex-col justify-center items-center px-margin md:px-margin-tablet">
        <div class="flex flex-col w-full items-center justify-center py-6 md:py-12 relative overflow-hidden">
            <div
                class="absolute -top-32 -left-32 w-96 h-96 rounded-full bg-primary-container/5 blur-3xl pointer-events-none">
            </div>
            <div
                class="absolute top-1/2 -right-40 w-96 h-96 rounded-full bg-surface-container-highest/40 blur-3xl pointer-events-none">
            </div>

            <div class="w-full max-w-lg relative z-10">
                <div
                    class="bg-surface-container-lowest rounded-xl shadow-xl p-6 sm:p-8 md:p-10 transition-all duration-300">
                    <div class="flex flex-col items-center text-center mb-8">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-primary-container flex items-center justify-center shadow-md shadow-primary/20 text-on-primary">
                                <span class="material-symbols-outlined text-3xl">menu_book</span>
                            </div>
                            <div class="text-left">
                                <div
                                    class="flex items-center text-headline-md font-headline-md tracking-tight leading-none text-on-surface">
                                    <span>Smart</span><span class="text-primary-container">Library</span>
                                </div>
                                <p
                                    class="text-label-sm font-label-sm tracking-wider uppercase text-secondary font-bold mt-1">
                                    Perpustakaan Digital
                                </p>
                            </div>
                        </div>
                        <h1 class="text-headline-md font-headline-md text-on-surface mb-1">
                            Buat akun baru
                        </h1>
                        <p class="text-body-md font-body-md text-on-surface-variant max-w-xs">
                            Isi data di bawah ini untuk mendaftar akun civitas perpustakaan digital
                        </p>
                    </div>

                    @if ($errors->any())
                        <div class="bg-error-container text-on-error-container p-4 rounded-lg mb-4">
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}" class="space-y-4" id="registerForm">
                        @csrf

                        <div>
                            <label class="flex items-center gap-1 text-label-md font-label-md text-on-surface mb-1.5">
                                Nama Lengkap <span class="text-error font-bold">*</span>
                            </label>
                            <div class="relative flex items-center">
                                <span
                                    class="material-symbols-outlined absolute left-3.5 text-secondary pointer-events-none text-xl">person</span>
                                <input name="name" value="{{ old('name') }}" required type="text"
                                    class="w-full h-11 pl-11 pr-4 bg-surface rounded-lg text-body-md font-body-md text-on-surface placeholder:text-outline focus:outline-none focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container/20 transition-all duration-150"
                                    placeholder="contoh: Ahmad Dahlan" />
                            </div>
                            @error('name')
                                <p class="text-error text-body-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="flex items-center gap-1 text-label-md font-label-md text-on-surface mb-1.5">
                                NISN / NIK Siswa atau Mahasiswa <span class="text-error font-bold">*</span>
                            </label>
                            <div class="relative flex items-center">
                                <span
                                    class="material-symbols-outlined absolute left-3.5 text-secondary pointer-events-none text-xl">badge</span>
                                <input name="nisn" value="{{ old('nisn') }}" required inputmode="numeric"
                                    type="text"
                                    class="w-full h-11 pl-11 pr-4 bg-surface rounded-lg text-body-md font-body-md text-on-surface placeholder:text-outline focus:outline-none focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container/20 transition-all duration-150"
                                    placeholder="10 digit NISN atau NIK valid" />
                            </div>
                            @error('nisn')
                                <p class="text-error text-body-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="flex items-center gap-1 text-label-md font-label-md text-on-surface mb-1.5">
                                Email Institusi / Pribadi <span class="text-error font-bold">*</span>
                            </label>
                            <div class="relative flex items-center">
                                <span
                                    class="material-symbols-outlined absolute left-3.5 text-secondary pointer-events-none text-xl">mail</span>
                                <input name="email" value="{{ old('email') }}" required type="email"
                                    class="w-full h-11 pl-11 pr-4 bg-surface rounded-lg text-body-md font-body-md text-on-surface placeholder:text-outline focus:outline-none focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container/20 transition-all duration-150"
                                    placeholder="nama@sekolah.id atau email@gmail.com" />
                            </div>
                            @error('email')
                                <p class="text-error text-body-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="flex items-center gap-1 text-label-md font-label-md text-on-surface mb-1.5">
                                Password / Kata Sandi <span class="text-error font-bold">*</span>
                            </label>
                            <div class="relative flex items-center">
                                <span
                                    class="material-symbols-outlined absolute left-3.5 text-secondary pointer-events-none text-xl">lock</span>
                                <input name="password" required minlength="8" type="password" id="passwordInput"
                                    class="w-full h-11 pl-11 pr-11 bg-surface rounded-lg text-body-md font-body-md text-on-surface placeholder:text-outline focus:outline-none focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container/20 transition-all duration-150"
                                    placeholder="Minimal 8 karakter" />
                                <button aria-label="Tampilkan atau sembunyikan kata sandi"
                                    class="absolute right-2.5 p-1 text-secondary hover:text-on-surface rounded flex items-center justify-center focus:outline-none"
                                    onclick="togglePasswordVisibility('passwordInput', 'passwordToggleIcon')"
                                    type="button">
                                    <span class="material-symbols-outlined text-xl"
                                        id="passwordToggleIcon">visibility</span>
                                </button>
                            </div>
                            @error('password')
                                <p class="text-error text-body-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="flex items-center gap-1 text-label-md font-label-md text-on-surface mb-1.5">
                                Konfirmasi Kata Sandi <span class="text-error font-bold">*</span>
                            </label>
                            <div class="relative flex items-center">
                                <span
                                    class="material-symbols-outlined absolute left-3.5 text-secondary pointer-events-none text-xl">lock_reset</span>
                                <input name="password_confirmation" required minlength="8" type="password"
                                    id="confirmPasswordInput"
                                    class="w-full h-11 pl-11 pr-11 bg-surface rounded-lg text-body-md font-body-md text-on-surface placeholder:text-outline focus:outline-none focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container/20 transition-all duration-150"
                                    placeholder="Ulangi kata sandi Anda" />
                                <button aria-label="Tampilkan atau sembunyikan konfirmasi kata sandi"
                                    class="absolute right-2.5 p-1 text-secondary hover:text-on-surface rounded flex items-center justify-center focus:outline-none"
                                    onclick="togglePasswordVisibility('confirmPasswordInput', 'confirmToggleIcon')"
                                    type="button">
                                    <span class="material-symbols-outlined text-xl"
                                        id="confirmToggleIcon">visibility</span>
                                </button>
                            </div>
                        </div>

                        <div class="pt-1">
                            <label class="flex items-start gap-2.5 cursor-pointer select-none">
                                <input name="terms" type="checkbox" required
                                    class="mt-1 w-4 h-4 rounded text-primary-container focus:ring-primary-container/30 cursor-pointer accent-primary-container" />
                                <span class="text-body-sm font-body-sm text-on-surface-variant leading-relaxed">
                                    Saya menyetujui <a class="text-primary-container font-semibold hover:underline"
                                        href="#">Syarat & Ketentuan</a> serta <a
                                        class="text-primary-container font-semibold hover:underline"
                                        href="#">Kebijakan Privasi</a> Smart Library.
                                </span>
                            </label>
                            @error('terms')
                                <p class="text-error text-body-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full h-11 mt-2 bg-primary-container hover:bg-primary text-on-primary font-label-lg text-label-lg rounded-lg shadow-md shadow-primary/20 flex items-center justify-center gap-2 active:scale-[0.99] transition-all duration-150">
                            <span>Daftar Sekarang</span>
                            <span class="material-symbols-outlined text-lg">arrow_forward</span>
                        </button>
                    </form>

                    <div class="relative flex items-center justify-center my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full h-[1px] bg-surface-container"></div>
                        </div>
                        <span
                            class="relative px-3 bg-surface-container-lowest text-label-sm font-label-sm uppercase tracking-wider text-outline">
                            Atau Daftar Dengan
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <button
                            class="w-full h-11 px-3 bg-surface hover:bg-surface-container-low text-on-surface rounded-lg flex items-center justify-center gap-2.5 text-label-sm font-label-sm transition-all duration-150 shadow-sm"
                            type="button">
                            <svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24">
                                <path
                                    d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                    fill="#4285F4"></path>
                                <path
                                    d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                    fill="#34A853"></path>
                                <path
                                    d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"
                                    fill="#FBBC05"></path>
                                <path
                                    d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"
                                    fill="#EA4335"></path>
                            </svg>
                            <span class="truncate">Google / Belajar.id</span>
                        </button>
                        <button
                            class="w-full h-11 px-3 bg-surface hover:bg-surface-container-low text-on-surface rounded-lg flex items-center justify-center gap-2 text-label-sm font-label-sm transition-all duration-150 shadow-sm"
                            type="button">
                            <span class="material-symbols-outlined text-primary-container text-lg">verified_user</span>
                            <span class="truncate">SSO Civitas Kampus</span>
                        </button>
                    </div>

                    <div class="mt-6 pt-5 text-center">
                        <p class="text-body-sm font-body-sm text-on-surface-variant">
                            Sudah punya akun perpustakaan?
                            <a class="text-primary-container font-label-lg text-label-lg hover:underline inline-flex items-center gap-0.5 ml-1"
                                href="#">
                                Masuk sekarang
                                <span class="material-symbols-outlined text-sm">chevron_right</span>
                            </a>
                        </p>
                    </div>
                </div>

                <div class="mt-6 flex flex-col items-center text-center space-y-3 px-2">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-surface-container-high/60 text-tertiary font-label-sm text-label-sm shadow-sm">
                        <span class="material-symbols-outlined text-base">verified</span>
                        <span>Akses Gratis ke 12.000+ Bahan Pustaka & Jurnal Digital</span>
                    </div>
                    <p class="text-body-sm font-body-sm text-outline">
                        © 2024 Smart Library. Perpustakaan Digital Terakreditasi Nasional.
                    </p>
                </div>
            </div>

            <div
                class="fixed bottom-4 right-4 hidden lg:flex items-center gap-3 p-3 bg-surface-container-lowest/80 backdrop-blur-md rounded-xl shadow-md pointer-events-none z-0">
                <div
                    class="w-10 h-10 rounded-lg bg-surface-container-high flex items-center justify-center text-primary-container">
                    <span class="material-symbols-outlined text-2xl">auto_stories</span>
                </div>
                <div class="text-left">
                    <div class="text-label-sm font-label-sm text-on-surface font-bold">Koleksi Terbuka</div>
                    <div class="text-body-sm font-body-sm text-secondary">E-Book • Jurnal • Audio</div>
                </div>
            </div>
        </div>

        <script>
            function togglePasswordVisibility(inputId, iconId) {
                const input = document.getElementById(inputId);
                const icon = document.getElementById(iconId);
                if (!input || !icon) return;

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.textContent = 'visibility_off';
                } else {
                    input.type = 'password';
                    icon.textContent = 'visibility';
                }
            }
        </script>
    </main>
</body>

</html>
