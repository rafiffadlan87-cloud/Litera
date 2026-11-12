<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Kelola Petugas - LITERA Admin</title>
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

    <div class="lg:pl-72 min-h-screen flex flex-col bg-background">
        <header
            class="fixed top-0 left-0 lg:left-72 right-0 h-16 pl-16 lg:pl-margin-tablet bg-surface-container-lowest/90 backdrop-blur-xl shadow-sm z-40 flex items-center justify-between px-margin-tablet">
            <div class="flex items-center gap-space-xs text-on-surface-variant font-label-md">
                <span class="text-secondary">Panel Admin</span>
                <span class="material-symbols-outlined text-[16px] text-outline">chevron_right</span>
                <span class="text-primary font-bold">Kelola Petugas</span>
            </div>
            <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center">
                <span class="material-symbols-outlined text-on-primary text-[18px]">shield_person</span>
            </div>
        </header>

        <main class="w-full pt-16 bg-background flex-1 p-space-xl">
            <div class="flex flex-col w-full gap-space-xl">

                {{-- Alert --}}
                @if (session('success'))
                    <div
                        class="p-4 rounded-xl bg-tertiary-fixed text-on-tertiary-fixed-variant flex items-center gap-2">
                        <span class="material-symbols-outlined">check_circle</span>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div class="p-4 rounded-xl bg-error-container text-on-error-container flex items-center gap-2">
                        <span class="material-symbols-outlined">error</span>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="p-4 rounded-xl bg-error-container text-on-error-container flex items-center gap-2">
                        <span class="material-symbols-outlined">error</span>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                {{-- Judul + Tombol Tambah --}}
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-md">
                    <div class="flex flex-col gap-space-xs">
                        <div class="flex items-center gap-space-sm">
                            <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Kelola Petugas
                            </h1>
                            <span
                                class="inline-flex items-center px-space-sm py-0.5 rounded-full bg-secondary-container text-on-secondary-container font-label-sm font-semibold">Staf
                                Sirkulasi</span>
                        </div>
                        <p class="font-body-md text-on-surface-variant max-w-3xl">
                            Kelola akun petugas perpustakaan yang berwenang memproses sirkulasi peminjaman &
                            pengembalian buku.
                        </p>
                    </div>
                    <button onclick="openModal('addModal')"
                        class="inline-flex items-center gap-space-xs h-10 px-space-lg rounded-xl bg-primary-container text-on-primary font-label-lg shadow-md hover:bg-primary transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[20px]">person_add</span>
                        <span>+ Tambah Petugas</span>
                    </button>
                </div>

                {{-- 3 Kartu Statistik --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-space-md">
                    <div class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm flex flex-col gap-space-sm">
                        <div class="flex items-center justify-between">
                            <span class="font-label-md text-on-surface-variant font-semibold">Total Petugas</span>
                            <div
                                class="w-10 h-10 rounded-xl bg-primary-fixed flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined text-[22px]">badge</span>
                            </div>
                        </div>
                        <div class="font-headline-lg text-headline-lg text-on-surface font-bold">
                            {{ $stats['total'] }} <span class="font-headline-sm font-normal text-outline">Akun</span>
                        </div>
                    </div>
                    <div class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm flex flex-col gap-space-sm">
                        <div class="flex items-center justify-between">
                            <span class="font-label-md text-on-surface-variant font-semibold">Petugas Aktif</span>
                            <div
                                class="w-10 h-10 rounded-xl bg-tertiary-container/15 flex items-center justify-center text-tertiary">
                                <span class="material-symbols-outlined text-[22px]">verified</span>
                            </div>
                        </div>
                        <div class="font-headline-lg text-headline-lg text-on-surface font-bold">
                            {{ $stats['aktif'] }} <span class="font-headline-sm font-normal text-outline">Akun</span>
                        </div>
                    </div>
                    <div class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm flex flex-col gap-space-sm">
                        <div class="flex items-center justify-between">
                            <span class="font-label-md text-on-surface-variant font-semibold">Ditangguhkan</span>
                            <div
                                class="w-10 h-10 rounded-xl bg-surface-container-high flex items-center justify-center text-on-surface-variant">
                                <span class="material-symbols-outlined text-[22px]">person_off</span>
                            </div>
                        </div>
                        <div class="font-headline-lg text-headline-lg text-on-surface font-bold">
                            {{ $stats['suspended'] }} <span
                                class="font-headline-sm font-normal text-outline">Akun</span>
                        </div>
                    </div>
                </div>

                {{-- Tabel Petugas --}}
                <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-surface-container-low/70 text-on-surface-variant font-label-sm uppercase">
                                    <th class="py-space-md px-space-lg w-16 text-center">NO</th>
                                    <th class="py-space-md px-space-lg">NAMA PETUGAS</th>
                                    <th class="py-space-md px-space-lg">EMAIL</th>
                                    <th class="py-space-md px-space-lg">STATUS</th>
                                    <th class="py-space-md px-space-lg">TERDAFTAR</th>
                                    <th class="py-space-md px-space-lg text-right">AKSI</th>
                                </tr>
                            </thead>
                            <tbody class="font-body-md text-on-surface">
                                @forelse($petugas as $i => $p)
                                    @php
                                        $initials = collect(explode(' ', $p->name))
                                            ->take(2)
                                            ->map(fn($w) => strtoupper(substr($w, 0, 1)))
                                            ->join('');
                                    @endphp
                                    <tr
                                        class="hover:bg-surface-container-low/40 transition-colors border-t border-outline-variant/30">
                                        <td class="py-space-md px-space-lg text-center font-label-md text-outline">
                                            {{ $i + 1 }}</td>
                                        <td class="py-space-md px-space-lg">
                                            <div class="flex items-center gap-space-md">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container font-bold font-label-lg shrink-0">
                                                    {{ $initials }}
                                                </div>
                                                <span
                                                    class="font-headline-sm text-on-surface font-semibold">{{ $p->name }}</span>
                                            </div>
                                        </td>
                                        <td class="py-space-md px-space-lg text-body-sm text-on-surface-variant">
                                            {{ $p->email }}</td>
                                        <td class="py-space-md px-space-lg">
                                            @if ($p->status === 'aktif')
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-space-sm py-1 rounded-full bg-tertiary-container/15 text-tertiary font-label-sm font-bold">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-tertiary"></span> Aktif
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-space-sm py-1 rounded-full bg-surface-container-high text-on-surface-variant font-label-sm font-bold">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-outline"></span>
                                                    Ditangguhkan
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-space-md px-space-lg text-body-sm text-outline">
                                            {{ $p->created_at->format('d M Y') }}</td>
                                        <td class="py-space-md px-space-lg text-right">
                                            <div class="flex items-center justify-end gap-space-xs">
                                                <button onclick='openEditPetugas(@json($p))'
                                                    class="w-8 h-8 rounded-lg text-outline hover:text-primary-container hover:bg-surface-container-low transition-colors"
                                                    title="Edit">
                                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                                </button>
                                                <form method="POST"
                                                    action="{{ route('admin.petugas.reset-password', $p->id) }}"
                                                    onsubmit="return confirm('Reset password {{ $p->name }} menjadi password123?');">
                                                    @csrf
                                                    <button type="submit"
                                                        class="w-8 h-8 rounded-lg text-outline hover:text-amber-600 hover:bg-amber-50 transition-colors"
                                                        title="Reset Password">
                                                        <span
                                                            class="material-symbols-outlined text-[18px]">lock_reset</span>
                                                    </button>
                                                </form>
                                                <form method="POST"
                                                    action="{{ route('admin.petugas.destroy', $p->id) }}"
                                                    onsubmit="return confirm('Hapus petugas {{ $p->name }}? Tindakan ini permanen.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="w-8 h-8 rounded-lg text-outline hover:text-error hover:bg-error-container/40 transition-colors"
                                                        title="Hapus">
                                                        <span
                                                            class="material-symbols-outlined text-[18px]">delete</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-space-lg py-12 text-center">
                                            <span
                                                class="material-symbols-outlined text-[40px] text-outline">badge</span>
                                            <p class="font-body-md text-secondary mt-2">Belum ada akun petugas.
                                                Tambahkan lewat tombol di atas.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    {{-- MODAL TAMBAH PETUGAS --}}
    <div id="addModal"
        class="fixed inset-0 z-[60] hidden bg-inverse-surface/60 backdrop-blur-sm flex items-center justify-center p-margin">
        <div class="w-full max-w-md bg-surface-container-lowest rounded-2xl shadow-2xl p-space-xl">
            <div class="flex items-center justify-between mb-space-md">
                <h3 class="font-headline-md text-on-surface flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">person_add</span>
                    <span>Tambah Petugas</span>
                </h3>
                <button onclick="closeModal('addModal')"
                    class="w-8 h-8 rounded-full bg-surface-container-low hover:bg-surface-container text-on-surface-variant flex items-center justify-center">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.petugas.store') }}" class="flex flex-col gap-space-md">
                @csrf
                <div class="flex flex-col gap-space-xs">
                    <label class="font-label-md">Nama Lengkap</label>
                    <input name="name" required
                        class="px-4 py-2.5 bg-surface-container-low rounded-lg text-on-surface outline-none focus:ring-2 focus:ring-primary-container" />
                </div>
                <div class="flex flex-col gap-space-xs">
                    <label class="font-label-md">Email</label>
                    <input type="email" name="email" required
                        class="px-4 py-2.5 bg-surface-container-low rounded-lg text-on-surface outline-none focus:ring-2 focus:ring-primary-container" />
                </div>
                <div class="flex flex-col gap-space-xs">
                    <label class="font-label-md">Password</label>
                    <input type="password" name="password" required minlength="6"
                        class="px-4 py-2.5 bg-surface-container-low rounded-lg text-on-surface outline-none focus:ring-2 focus:ring-primary-container" />
                </div>
                <div class="flex flex-col gap-space-xs">
                    <label class="font-label-md">Status</label>
                    <select name="status" required
                        class="px-4 py-2.5 bg-surface-container-low rounded-lg text-on-surface outline-none">
                        <option value="aktif">Aktif</option>
                        <option value="suspended">Ditangguhkan</option>
                    </select>
                </div>
                <div class="flex items-center justify-end gap-space-sm mt-2">
                    <button type="button" onclick="closeModal('addModal')"
                        class="px-4 py-2 rounded-lg bg-surface-container-low hover:bg-surface-container text-on-surface font-label-md transition-colors">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 rounded-lg bg-primary-container hover:bg-primary text-on-primary font-label-md font-bold shadow-sm">Simpan
                        Petugas</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT PETUGAS --}}
    <div id="editModal"
        class="fixed inset-0 z-[60] hidden bg-inverse-surface/60 backdrop-blur-sm flex items-center justify-center p-margin">
        <div class="w-full max-w-md bg-surface-container-lowest rounded-2xl shadow-2xl p-space-xl">
            <div class="flex items-center justify-between mb-space-md">
                <h3 class="font-headline-md text-on-surface flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">edit</span>
                    <span>Edit Petugas</span>
                </h3>
                <button onclick="closeModal('editModal')"
                    class="w-8 h-8 rounded-full bg-surface-container-low hover:bg-surface-container text-on-surface-variant flex items-center justify-center">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <form method="POST" id="editForm" class="flex flex-col gap-space-md">
                @csrf
                @method('PUT')
                <div class="flex flex-col gap-space-xs">
                    <label class="font-label-md">Nama Lengkap</label>
                    <input name="name" id="editName" required
                        class="px-4 py-2.5 bg-surface-container-low rounded-lg text-on-surface outline-none focus:ring-2 focus:ring-primary-container" />
                </div>
                <div class="flex flex-col gap-space-xs">
                    <label class="font-label-md">Email</label>
                    <input type="email" name="email" id="editEmail" required
                        class="px-4 py-2.5 bg-surface-container-low rounded-lg text-on-surface outline-none focus:ring-2 focus:ring-primary-container" />
                </div>
                <div class="flex flex-col gap-space-xs">
                    <label class="font-label-md">Status</label>
                    <select name="status" id="editStatus" required
                        class="px-4 py-2.5 bg-surface-container-low rounded-lg text-on-surface outline-none">
                        <option value="aktif">Aktif</option>
                        <option value="suspended">Ditangguhkan</option>
                    </select>
                </div>
                <div class="flex items-center justify-end gap-space-sm mt-2">
                    <button type="button" onclick="closeModal('editModal')"
                        class="px-4 py-2 rounded-lg bg-surface-container-low hover:bg-surface-container text-on-surface font-label-md transition-colors">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 rounded-lg bg-primary-container hover:bg-primary text-on-primary font-label-md font-bold shadow-sm">Simpan
                        Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        function openEditPetugas(p) {
            document.getElementById('editForm').action = '/admin/petugas/' + p.id;
            document.getElementById('editName').value = p.name;
            document.getElementById('editEmail').value = p.email;
            document.getElementById('editStatus').value = p.status;
            openModal('editModal');
        }

        document.querySelectorAll('#addModal, #editModal').forEach(modal => {
            modal.addEventListener('click', e => {
                if (e.target === modal) modal.classList.add('hidden');
            });
        });
    </script>

</body>

</html>
