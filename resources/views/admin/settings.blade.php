<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Pengaturan - LITERA Admin</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500..700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary-fixed-dim": "#b4c5ff",
                        "primary-container": "#2563eb",
                        background: "#f8f9ff",
                        "surface-container-low": "#eff4ff",
                        "on-primary": "#ffffff",
                        "primary-fixed": "#dbe1ff",
                        "tertiary-fixed-dim": "#4edea3",
                        "inverse-surface": "#213145",
                        "surface-container-lowest": "#ffffff",
                        tertiary: "#006242",
                        "error-container": "#ffdad6",
                        "secondary-fixed": "#d8e3fb",
                        "tertiary-fixed": "#6ffbbe",
                        "on-background": "#0b1c30",
                        "on-primary-fixed": "#00174b",
                        "inverse-primary": "#b4c5ff",
                        "secondary-container": "#d5e0f8",
                        "outline-variant": "#c3c6d7",
                        surface: "#f8f9ff",
                        "inverse-on-surface": "#eaf1ff",
                        secondary: "#545f73",
                        "surface-container": "#e5eeff",
                        "secondary-fixed-dim": "#bcc7de",
                        "on-surface-variant": "#434655",
                        "tertiary-container": "#007d55",
                        "surface-variant": "#d3e4fe",
                        "surface-container-highest": "#d3e4fe",
                        error: "#ba1a1a",
                        "surface-container-high": "#dce9ff",
                        "on-surface": "#0b1c30",
                        primary: "#004ac6",
                        "on-error-container": "#93000a",
                        outline: "#737686"
                    },
                    spacing: {
                        "margin-tablet": "1.5rem",
                        "space-xs": "0.25rem",
                        "space-xl": "1.5rem",
                        "space-sm": "0.5rem",
                        "space-md": "0.75rem",
                        margin: "1rem",
                        "space-lg": "1rem"
                    },
                    fontFamily: {
                        "body-md": ["Plus Jakarta Sans", "sans-serif"],
                        "headline-lg": ["Fraunces", "serif"],
                        "label-sm": ["Plus Jakarta Sans"],
                        "label-md": ["Plus Jakarta Sans"],
                        "headline-sm": ["Fraunces", "serif"],
                        "label-lg": ["Plus Jakarta Sans"],
                        "headline-md": ["Fraunces", "serif"],
                        "body-lg": ["Plus Jakarta Sans"],
                        "body-sm": ["Plus Jakarta Sans"]
                    }
                }
            }
        };
    </script>
</head>

<body class="bg-background font-body-md text-on-surface antialiased">

    @include('partials.admin-sidebar')

    <div class="lg:pl-72 flex flex-col min-h-screen">
        <header
            class="fixed top-0 left-0 lg:left-0 lg:left-72 right-0 h-16 pl-16 lg:pl-margin-tablet bg-surface-container-lowest/90 backdrop-blur-xl shadow-sm z-40 flex items-center justify-between pr-margin-tablet">
            <div class="flex items-center gap-space-xs text-on-surface-variant font-label-md">
                <span class="text-secondary">Panel Admin</span>
                <span class="material-symbols-outlined text-[16px] text-outline">chevron_right</span>
                <span class="text-primary font-bold">Pengaturan</span>
            </div>
            <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center">
                <span class="material-symbols-outlined text-on-primary text-[18px]">shield_person</span>
            </div>
        </header>

        <main class="w-full pt-16 bg-background flex-1 p-space-xl">
            <div class="flex flex-col w-full gap-space-xl">

                @if (session('success'))
                    <div
                        class="p-4 rounded-xl bg-tertiary-fixed text-on-tertiary-fixed-variant flex items-center gap-2">
                        <span class="material-symbols-outlined">check_circle</span>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="p-4 rounded-xl bg-error-container text-on-error-container flex items-center gap-2">
                        <span class="material-symbols-outlined">error</span>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <div class="flex flex-col gap-space-xs">
                    <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Pengaturan Sistem</h1>
                    <p class="font-body-md text-on-surface-variant max-w-3xl">
                        Atur kebijakan peminjaman, denda keterlambatan, dan durasi perpanjangan buku. Perubahan berlaku
                        otomatis untuk seluruh transaksi baru.
                    </p>
                </div>

                <div class="bg-surface-container-lowest rounded-xl shadow-sm p-space-lg max-w-2xl">
                    <form method="POST" action="{{ route('admin.settings.update') }}"
                        class="flex flex-col gap-space-lg">
                        @csrf

                        {{-- Durasi Peminjaman --}}
                        <div class="flex flex-col gap-space-sm">
                            <label class="font-label-lg text-on-surface font-semibold flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-[20px]">event</span>
                                Durasi Peminjaman Default
                            </label>
                            <div class="relative">
                                <input type="number" name="max_borrow_days" value="{{ $settings['max_borrow_days'] }}"
                                    required min="1" max="365"
                                    class="w-full px-4 py-3 bg-surface-container-low rounded-lg text-on-surface font-body-md outline-none focus:ring-2 focus:ring-primary-container pr-20" />
                                <span
                                    class="absolute right-4 top-1/2 -translate-y-1/2 font-label-md text-outline">hari</span>
                            </div>
                            <p class="font-body-sm text-on-surface-variant">Jumlah hari maksimal peminjaman buku sebelum
                                jatuh tempo.</p>
                        </div>

                        {{-- Denda Per Hari --}}
                        <div class="flex flex-col gap-space-sm">
                            <label class="font-label-lg text-on-surface font-semibold flex items-center gap-2">
                                <span class="material-symbols-outlined text-error text-[20px]">payments</span>
                                Denda Keterlambatan Per Hari
                            </label>
                            <div class="relative">
                                <span
                                    class="absolute left-4 top-1/2 -translate-y-1/2 font-label-md text-outline">Rp</span>
                                <input type="number" name="fine_per_day" value="{{ $settings['fine_per_day'] }}"
                                    required min="0" max="1000000"
                                    class="w-full px-4 py-3 bg-surface-container-low rounded-lg text-on-surface font-body-md outline-none focus:ring-2 focus:ring-primary-container pl-12" />
                            </div>
                            <p class="font-body-sm text-on-surface-variant">Nominal denda yang dikenakan untuk setiap
                                hari keterlambatan pengembalian.</p>
                        </div>

                        {{-- Durasi Perpanjangan --}}
                        <div class="flex flex-col gap-space-sm">
                            <label class="font-label-lg text-on-surface font-semibold flex items-center gap-2">
                                <span class="material-symbols-outlined text-tertiary text-[20px]">update</span>
                                Durasi Perpanjangan Buku
                            </label>
                            <div class="relative">
                                <input type="number" name="max_extension_days"
                                    value="{{ $settings['max_extension_days'] }}" required min="1" max="365"
                                    class="w-full px-4 py-3 bg-surface-container-low rounded-lg text-on-surface font-body-md outline-none focus:ring-2 focus:ring-primary-container pr-20" />
                                <span
                                    class="absolute right-4 top-1/2 -translate-y-1/2 font-label-md text-outline">hari</span>
                            </div>
                            <p class="font-body-sm text-on-surface-variant">Jumlah hari tambahan yang diberikan saat
                                perpanjangan disetujui petugas.</p>
                        </div>

                        {{-- Tombol Simpan --}}
                        <div
                            class="flex items-center justify-end gap-space-sm pt-space-md border-t border-outline-variant/30">
                            <button type="reset"
                                class="px-4 py-2.5 rounded-lg bg-surface-container-low hover:bg-surface-container text-on-surface font-label-md transition-colors">
                                Reset ke Default
                            </button>
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-6 py-2.5 rounded-lg bg-primary-container hover:bg-primary text-on-primary font-label-md font-bold shadow-sm transition-all">
                                <span class="material-symbols-outlined text-[18px]">save</span>
                                Simpan Pengaturan
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Info Card --}}
                <div class="p-space-md rounded-xl bg-primary-fixed/40 flex items-start gap-space-md max-w-2xl">
                    <div
                        class="w-9 h-9 rounded-full bg-primary-container text-on-primary flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-[18px]">info</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="font-label-md text-on-primary-fixed font-bold">Catatan Penting</span>
                        <span class="font-body-sm text-on-surface-variant leading-relaxed">
                            Perubahan pengaturan hanya berlaku untuk <strong>transaksi baru</strong>. Peminjaman yang
                            sudah berjalan tetap mengikuti aturan lama saat transaksi dibuat.
                            Denda keterlambatan dihitung otomatis oleh sistem saat petugas memproses pengembalian buku.
                        </span>
                    </div>
                </div>

            </div>
        </main>
    </div>
</body>

</html>
