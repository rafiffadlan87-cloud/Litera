<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Kelola Anggota - LITERA Admin</title>
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
                <span class="text-primary font-bold">Kelola Anggota</span>
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

                {{-- Header --}}
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-md">
                    <div class="flex flex-col gap-space-xs">
                        <div class="flex items-center gap-space-sm">
                            <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Kelola Data
                                Anggota</h1>
                            <span
                                class="inline-flex items-center px-space-sm py-0.5 rounded-full bg-secondary-container text-on-secondary-container font-label-sm font-semibold">Siswa
                                & Guru</span>
                        </div>
                        <p class="font-body-md text-on-surface-variant max-w-3xl">
                            Kelola data anggota perpustakaan, status keaktifan akun, dan riwayat sirkulasi peminjaman
                            buku.
                        </p>
                    </div>
                    <button onclick="openModal('addModal')"
                        class="inline-flex items-center gap-space-xs h-10 px-space-lg rounded-xl bg-primary-container text-on-primary font-label-lg shadow-md hover:bg-primary transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[20px]">person_add</span>
                        <span>+ Tambah Anggota</span>
                    </button>
                </div>

                {{-- 4 Kartu Statistik --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-space-md">
                    @php
                        $cards = [
                            [
                                'label' => 'Total Anggota',
                                'icon' => 'groups',
                                'value' => $stats['total'],
                                'suffix' => 'Orang',
                                'bg' => 'bg-primary-fixed',
                                'color' => 'text-primary',
                            ],
                            [
                                'label' => 'Anggota Aktif',
                                'icon' => 'verified',
                                'value' => $stats['aktif'],
                                'suffix' => 'Akun',
                                'bg' => 'bg-tertiary-container/15',
                                'color' => 'text-tertiary',
                            ],
                            [
                                'label' => 'Peminjam Aktif',
                                'icon' => 'auto_stories',
                                'value' => $stats['peminjam'],
                                'suffix' => 'Siswa',
                                'bg' => 'bg-secondary-container',
                                'color' => 'text-primary-container',
                            ],
                            [
                                'label' => 'Perlu Verifikasi',
                                'icon' => 'pending_actions',
                                'value' => $stats['pending'],
                                'suffix' => 'Pendaftar',
                                'bg' => 'bg-surface-container-high',
                                'color' => 'text-on-surface-variant',
                            ],
                        ];
                    @endphp
                    @foreach ($cards as $c)
                        <div
                            class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm flex flex-col gap-space-sm">
                            <div class="flex items-center justify-between">
                                <span
                                    class="font-label-md text-on-surface-variant font-semibold">{{ $c['label'] }}</span>
                                <div
                                    class="w-10 h-10 rounded-xl {{ $c['bg'] }} flex items-center justify-center {{ $c['color'] }}">
                                    <span class="material-symbols-outlined text-[22px]">{{ $c['icon'] }}</span>
                                </div>
                            </div>
                            <div class="font-headline-lg text-headline-lg text-on-surface font-bold">
                                {{ $c['value'] }} <span
                                    class="font-headline-sm font-normal text-outline">{{ $c['suffix'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Filter Toolbar --}}
                <div class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm flex flex-col gap-space-md">
                    <form method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-space-sm items-center">
                        {{-- Filter Pills --}}
                        <div class="md:col-span-12 flex items-center gap-space-xs overflow-x-auto pb-1">
                            @php $pills = ['all'=>'Semua','aktif'=>'Aktif','pending'=>'Menunggu Verifikasi','suspended'=>'Suspended']; @endphp
                            @foreach ($pills as $key => $label)
                                @php
                                    $count =
                                        $key === 'all'
                                            ? $stats['total']
                                            : ($key === 'pending'
                                                ? $stats['pending']
                                                : ($key === 'aktif'
                                                    ? $stats['aktif']
                                                    : $stats['total'] - $stats['aktif'] - $stats['pending']));
                                @endphp
                                <a href="{{ route('admin.members', array_merge(request()->except('status', 'page'), $key === 'all' ? [] : ['status' => $key])) }}"
                                    class="px-space-md py-1.5 rounded-full font-label-md font-semibold whitespace-nowrap transition-colors
                                      {{ request('status', 'all') === $key
                                          ? 'bg-primary-container text-on-primary shadow-sm'
                                          : 'bg-surface-container-low text-on-surface-variant hover:bg-surface-container-high' }}">
                                    {{ $label }} ({{ $count }})
                                </a>
                            @endforeach
                        </div>

                        {{-- Search --}}
                        <div class="md:col-span-5 relative flex items-center">
                            <span
                                class="material-symbols-outlined absolute left-space-md text-[20px] text-outline">search</span>
                            <input name="search" value="{{ request('search') }}"
                                class="w-full h-11 pl-10 pr-space-md bg-surface-container-low rounded-xl text-on-surface font-body-sm placeholder:text-outline focus:outline-none focus:bg-surface-container-lowest shadow-sm"
                                placeholder="Cari nama, email, atau NISN..." />
                        </div>

                        {{-- Filter Type --}}
                        <div class="md:col-span-2 relative">
                            <select name="type"
                                class="w-full h-11 px-space-md pr-8 bg-surface-container-low rounded-xl text-on-surface font-label-md appearance-none cursor-pointer focus:outline-none">
                                <option value="">Semua Peran</option>
                                <option value="siswa" {{ request('type') === 'siswa' ? 'selected' : '' }}>Siswa
                                </option>
                                <option value="guru" {{ request('type') === 'guru' ? 'selected' : '' }}>Guru</option>
                                <option value="staf" {{ request('type') === 'staf' ? 'selected' : '' }}>Staf</option>
                            </select>
                            <span
                                class="material-symbols-outlined absolute right-space-sm top-3 text-[18px] text-outline pointer-events-none">expand_more</span>
                        </div>

                        {{-- Filter Kelas --}}
                        <div class="md:col-span-2 relative">
                            <input name="kelas" value="{{ request('kelas') }}"
                                class="w-full h-11 px-space-md bg-surface-container-low rounded-xl text-on-surface font-label-md focus:outline-none"
                                placeholder="Kelas (XII IPA 2)" />
                        </div>

                        <button type="submit"
                            class="md:col-span-2 h-11 rounded-xl bg-primary-container text-on-primary hover:bg-primary font-label-md font-bold shadow-sm transition-all">
                            Cari & Filter
                        </button>
                        <a href="{{ route('admin.members') }}"
                            class="md:col-span-1 h-11 rounded-xl bg-surface-container-low text-on-surface-variant hover:bg-surface-container hover:text-on-surface flex items-center justify-center transition-colors"
                            title="Reset">
                            <span class="material-symbols-outlined text-[20px]">restart_alt</span>
                        </a>
                    </form>
                </div>

                {{-- Tabel --}}
                <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-surface-container-low/70 text-on-surface-variant font-label-sm uppercase">
                                    <th class="py-space-md px-space-lg w-16 text-center">NO</th>
                                    <th class="py-space-md px-space-lg">NAMA ANGGOTA</th>
                                    <th class="py-space-md px-space-lg">NISN</th>
                                    <th class="py-space-md px-space-lg">EMAIL</th>
                                    <th class="py-space-md px-space-lg">STATUS</th>
                                    <th class="py-space-md px-space-lg text-right">AKSI</th>
                                </tr>
                            </thead>
                            <tbody class="font-body-md text-on-surface">
                                @forelse($members as $i => $m)
                                    @php
                                        $initials = collect(explode(' ', $m->name))
                                            ->take(2)
                                            ->map(fn($w) => strtoupper(substr($w, 0, 1)))
                                            ->join('');
                                        $roleLabel = $m->borrower?->type ?? ucfirst($m->role);
                                        $status = $m->status;
                                    @endphp
                                    <tr
                                        class="hover:bg-surface-container-low/40 transition-colors border-t border-outline-variant/30">
                                        <td class="py-space-md px-space-lg text-center font-label-md text-outline">
                                            {{ $members->firstItem() + $i }}
                                        </td>
                                        <td class="py-space-md px-space-lg">
                                            <div class="flex items-center gap-space-md">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center text-primary font-bold font-label-lg shrink-0">
                                                    {{ $initials }}
                                                </div>
                                                <div class="flex flex-col min-w-0">
                                                    <span
                                                        class="font-headline-sm text-on-surface font-semibold truncate">{{ $m->name }}</span>
                                                    <span class="font-body-sm text-outline">
                                                        {{ ucfirst($roleLabel) }}{{ $m->borrower?->kelas ? ' • ' . $m->borrower->kelas : '' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-space-md px-space-lg font-mono text-body-sm text-on-surface">
                                            {{ $m->borrower->nisn ?? '-' }}
                                        </td>
                                        <td class="py-space-md px-space-lg text-body-sm text-on-surface-variant">
                                            {{ $m->email }}
                                        </td>
                                        <td class="py-space-md px-space-lg">
                                            @if ($status === 'aktif')
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-space-sm py-1 rounded-full bg-tertiary-container/15 text-tertiary font-label-sm font-bold">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-tertiary"></span> Aktif
                                                </span>
                                            @elseif($status === 'pending')
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-space-sm py-1 rounded-full bg-amber-100 text-amber-900 font-label-sm font-bold">
                                                    <span
                                                        class="w-1.5 h-1.5 rounded-full bg-amber-600 animate-pulse"></span>
                                                    Menunggu
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-space-sm py-1 rounded-full bg-surface-container-high text-on-surface-variant font-label-sm font-bold">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-outline"></span>
                                                    Ditangguhkan
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-space-md px-space-lg text-right">
                                            <div class="flex items-center justify-end gap-space-xs">
                                                <button onclick='openEditModal(@json($m))'
                                                    class="w-8 h-8 rounded-lg text-outline hover:text-primary-container hover:bg-surface-container-low transition-colors"
                                                    title="Edit">
                                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                                </button>
                                                <form method="POST"
                                                    action="{{ route('admin.members.reset-password', $m->id) }}"
                                                    onsubmit="return confirm('Reset password {{ $m->name }} menjadi password123?');">
                                                    @csrf
                                                    <button type="submit"
                                                        class="w-8 h-8 rounded-lg text-outline hover:text-amber-600 hover:bg-amber-50 transition-colors"
                                                        title="Reset Password">
                                                        <span
                                                            class="material-symbols-outlined text-[18px]">lock_reset</span>
                                                    </button>
                                                </form>
                                                <form method="POST"
                                                    action="{{ route('admin.members.destroy', $m->id) }}"
                                                    onsubmit="return confirm('Hapus anggota {{ $m->name }}? Tindakan ini permanen.');">
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
                                                class="material-symbols-outlined text-[40px] text-outline">group_off</span>
                                            <p class="font-body-md text-secondary mt-2">Tidak ada anggota ditemukan.
                                            </p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if ($members->hasPages())
                        <div
                            class="p-space-lg bg-surface-container-low/40 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-space-md">
                            <span class="font-body-sm text-on-surface-variant">
                                Menampilkan <strong>{{ $members->firstItem() }} – {{ $members->lastItem() }}</strong>
                                dari <strong>{{ $members->total() }}</strong> anggota
                            </span>
                            <div>{{ $members->links() }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    {{-- MODAL TAMBAH --}}
    <div id="addModal"
        class="fixed inset-0 z-[60] hidden bg-inverse-surface/60 backdrop-blur-sm flex items-center justify-center p-margin">
        <div class="w-full max-w-lg bg-surface-container-lowest rounded-2xl shadow-2xl p-space-xl">
            <div class="flex items-center justify-between mb-space-md">
                <h3 class="font-headline-md text-on-surface flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">person_add</span>
                    <span>Tambah Anggota</span>
                </h3>
                <button onclick="closeModal('addModal')"
                    class="w-8 h-8 rounded-full bg-surface-container-low hover:bg-surface-container text-on-surface-variant flex items-center justify-center">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.members.store') }}" class="flex flex-col gap-space-md">
                @csrf
                <div class="grid grid-cols-2 gap-space-md">
                    <div class="flex flex-col gap-space-xs col-span-2">
                        <label class="font-label-md">Nama Lengkap</label>
                        <input name="name" required
                            class="px-4 py-2.5 bg-surface-container-low rounded-lg text-on-surface outline-none focus:ring-2 focus:ring-primary-container" />
                    </div>
                    <div class="flex flex-col gap-space-xs col-span-2">
                        <label class="font-label-md">Email</label>
                        <input type="email" name="email" required
                            class="px-4 py-2.5 bg-surface-container-low rounded-lg text-on-surface outline-none focus:ring-2 focus:ring-primary-container" />
                    </div>
                    <div class="flex flex-col gap-space-xs">
                        <label class="font-label-md">Password</label>
                        <input type="password" name="password" required
                            class="px-4 py-2.5 bg-surface-container-low rounded-lg text-on-surface outline-none focus:ring-2 focus:ring-primary-container" />
                    </div>
                    <div class="flex flex-col gap-space-xs">
                        <label class="font-label-md">NISN</label>
                        <input name="nisn"
                            class="px-4 py-2.5 bg-surface-container-low rounded-lg text-on-surface outline-none focus:ring-2 focus:ring-primary-container" />
                    </div>
                    <div class="flex flex-col gap-space-xs">
                        <label class="font-label-md">Kelas</label>
                        <input name="kelas" placeholder="XII IPA 2"
                            class="px-4 py-2.5 bg-surface-container-low rounded-lg text-on-surface outline-none focus:ring-2 focus:ring-primary-container" />
                    </div>
                    <div class="flex flex-col gap-space-xs">
                        <label class="font-label-md">Tipe</label>
                        <select name="type" required
                            class="px-4 py-2.5 bg-surface-container-low rounded-lg text-on-surface outline-none">
                            <option value="siswa">Siswa</option>
                            <option value="guru">Guru</option>
                            <option value="staf">Staf</option>
                        </select>
                    </div>
                    <div class="flex flex-col gap-space-xs col-span-2">
                        <label class="font-label-md">Status</label>
                        <select name="status" required
                            class="px-4 py-2.5 bg-surface-container-low rounded-lg text-on-surface outline-none">
                            <option value="aktif">Aktif (langsung bisa pinjam)</option>
                            <option value="pending">Menunggu Verifikasi</option>
                        </select>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-space-sm mt-2">
                    <button type="button" onclick="closeModal('addModal')"
                        class="px-4 py-2 rounded-lg bg-surface-container-low hover:bg-surface-container text-on-surface font-label-md transition-colors">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 rounded-lg bg-primary-container hover:bg-primary text-on-primary font-label-md font-bold shadow-sm">Simpan
                        Anggota</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div id="editModal"
        class="fixed inset-0 z-[60] hidden bg-inverse-surface/60 backdrop-blur-sm flex items-center justify-center p-margin">
        <div class="w-full max-w-lg bg-surface-container-lowest rounded-2xl shadow-2xl p-space-xl">
            <div class="flex items-center justify-between mb-space-md">
                <h3 class="font-headline-md text-on-surface flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">edit</span>
                    <span>Edit Anggota</span>
                </h3>
                <button onclick="closeModal('editModal')"
                    class="w-8 h-8 rounded-full bg-surface-container-low hover:bg-surface-container text-on-surface-variant flex items-center justify-center">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <form method="POST" id="editForm" class="flex flex-col gap-space-md">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-space-md">
                    <div class="flex flex-col gap-space-xs col-span-2">
                        <label class="font-label-md">Nama Lengkap</label>
                        <input name="name" id="editName" required
                            class="px-4 py-2.5 bg-surface-container-low rounded-lg text-on-surface outline-none focus:ring-2 focus:ring-primary-container" />
                    </div>
                    <div class="flex flex-col gap-space-xs col-span-2">
                        <label class="font-label-md">Email</label>
                        <input type="email" name="email" id="editEmail" required
                            class="px-4 py-2.5 bg-surface-container-low rounded-lg text-on-surface outline-none focus:ring-2 focus:ring-primary-container" />
                    </div>
                    <div class="flex flex-col gap-space-xs">
                        <label class="font-label-md">NISN</label>
                        <input name="nisn" id="editNisn"
                            class="px-4 py-2.5 bg-surface-container-low rounded-lg text-on-surface outline-none focus:ring-2 focus:ring-primary-container" />
                    </div>
                    <div class="flex flex-col gap-space-xs">
                        <label class="font-label-md">Kelas</label>
                        <input name="kelas" id="editKelas"
                            class="px-4 py-2.5 bg-surface-container-low rounded-lg text-on-surface outline-none focus:ring-2 focus:ring-primary-container" />
                    </div>
                    <div class="flex flex-col gap-space-xs">
                        <label class="font-label-md">Tipe</label>
                        <select name="type" id="editType" required
                            class="px-4 py-2.5 bg-surface-container-low rounded-lg text-on-surface outline-none">
                            <option value="siswa">Siswa</option>
                            <option value="guru">Guru</option>
                            <option value="staf">Staf</option>
                        </select>
                    </div>
                    <div class="flex flex-col gap-space-xs">
                        <label class="font-label-md">Status</label>
                        <select name="status" id="editStatus" required
                            class="px-4 py-2.5 bg-surface-container-low rounded-lg text-on-surface outline-none">
                            <option value="aktif">Aktif</option>
                            <option value="pending">Menunggu</option>
                            <option value="suspended">Ditangguhkan</option>
                        </select>
                    </div>
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

        function openEditModal(member) {
            document.getElementById('editForm').action = '/admin/members/' + member.id;
            document.getElementById('editName').value = member.name;
            document.getElementById('editEmail').value = member.email;
            document.getElementById('editNisn').value = member.borrower?.nisn || '';
            document.getElementById('editKelas').value = member.borrower?.kelas || '';
            document.getElementById('editType').value = member.borrower?.type || 'siswa';
            document.getElementById('editStatus').value = member.status;
            openModal('editModal');
        }

        // Tutup modal saat klik backdrop
        document.querySelectorAll('#addModal, #editModal').forEach(modal => {
            modal.addEventListener('click', e => {
                if (e.target === modal) modal.classList.add('hidden');
            });
        });
    </script>

</body>

</html>
