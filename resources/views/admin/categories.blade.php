<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Kelola Kategori - LITERA Admin</title>
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

    {{-- SIDEBAR ADMIN --}}
    @include('partials.admin-sidebar')

    {{-- MAIN --}}
    <div class="lg:pl-72 flex flex-col min-h-screen">
        <header
            class="fixed top-0 left-0 lg:left-72 right-0 h-16 pl-16 lg:pl-margin-tablet bg-surface-container-lowest/90 backdrop-blur-xl shadow-sm z-40 flex items-center justify-between px-margin-tablet">
            <div class="flex items-center gap-space-xs text-on-surface-variant font-label-md">
                <span class="text-secondary">Panel Admin</span>
                <span class="material-symbols-outlined text-[16px] text-outline">chevron_right</span>
                <span class="text-primary font-bold">Kelola Kategori</span>
            </div>
            <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center">
                <span class="material-symbols-outlined text-on-primary text-[18px]">shield_person</span>
            </div>
        </header>

        <main class="relative pt-16 w-full flex-1 px-margin-tablet py-space-xl bg-background">
            <div class="flex flex-col w-full">

                {{-- Alert --}}
                @if (session('success'))
                    <div
                        class="p-4 rounded-xl bg-tertiary-fixed text-on-tertiary-fixed-variant flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined">check_circle</span>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div class="p-4 rounded-xl bg-error-container text-on-error-container flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined">error</span>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="p-4 rounded-xl bg-error-container text-on-error-container flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined">error</span>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                {{-- Judul --}}
                <div class="flex items-center justify-between mb-space-lg">
                    <div>
                        <h1 class="font-headline-lg text-headline-lg text-on-surface">Kelola Kategori</h1>
                        <p class="font-body-md text-secondary mt-1">Atur pengelompokan buku di katalog perpustakaan.</p>
                    </div>
                    <span
                        class="px-3 py-1.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-md">{{ $categories->count() }}
                        Kategori</span>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-space-md">

                    {{-- Form Tambah Kategori --}}
                    <div class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm h-fit">
                        <h2 class="font-headline-sm text-on-surface mb-space-md flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-[20px]">add_circle</span>
                            <span>Tambah Kategori</span>
                        </h2>
                        <form method="POST" action="{{ route('admin.categories.store') }}"
                            class="flex flex-col gap-space-md">
                            @csrf
                            <div class="flex flex-col gap-space-xs">
                                <label class="font-label-md text-on-surface-variant">Nama Kategori</label>
                                <input type="text" name="name" value="{{ old('name') }}" required
                                    maxlength="100"
                                    class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-on-surface font-body-md outline-none focus:ring-2 focus:ring-primary-container"
                                    placeholder="Contoh: Fiksi, Sains, Sejarah..." />
                            </div>
                            <button type="submit"
                                class="w-full py-2.5 bg-primary-container hover:bg-primary text-on-primary rounded-lg font-label-lg font-bold flex items-center justify-center gap-2 shadow-sm active:scale-95 transition-all">
                                <span class="material-symbols-outlined text-[20px]">add</span>
                                <span>Simpan Kategori</span>
                            </button>
                        </form>
                    </div>

                    {{-- Tabel Kategori --}}
                    <div class="lg:col-span-2 bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
                        <table class="w-full text-left">
                            <thead
                                class="bg-surface-container-low text-on-surface-variant font-label-sm uppercase tracking-wider">
                                <tr>
                                    <th class="px-space-lg py-space-md">#</th>
                                    <th class="px-space-lg py-space-md">Nama Kategori</th>
                                    <th class="px-space-lg py-space-md">Jumlah Buku</th>
                                    <th class="px-space-lg py-space-md text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant">
                                @forelse($categories as $i => $cat)
                                    <tr class="hover:bg-surface-container-low/50 transition-colors">
                                        <td class="px-space-lg py-space-md font-label-sm text-outline">
                                            {{ $i + 1 }}</td>
                                        <td class="px-space-lg py-space-md">
                                            <div class="flex items-center gap-space-sm">
                                                <span
                                                    class="w-8 h-8 rounded-lg bg-primary-fixed text-primary flex items-center justify-center">
                                                    <span class="material-symbols-outlined text-[16px]">sell</span>
                                                </span>
                                                <span class="font-label-lg text-on-surface">{{ $cat->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-space-lg py-space-md">
                                            <span
                                                class="px-2.5 py-1 rounded-full {{ $cat->books_count > 0 ? 'bg-secondary-fixed text-on-secondary-fixed' : 'bg-surface-container text-outline' }} font-label-sm">
                                                {{ $cat->books_count }} buku
                                            </span>
                                        </td>
                                        <td class="px-space-lg py-space-md">
                                            <div class="flex items-center justify-end gap-space-xs">
                                                <button type="button" data-edit-id="{{ $cat->id }}"
                                                    data-edit-name="{{ $cat->name }}"
                                                    class="w-8 h-8 rounded-lg bg-surface-container-low hover:bg-surface-container text-primary flex items-center justify-center transition-colors">
                                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                                </button>
                                                <form method="POST"
                                                    action="{{ route('admin.categories.destroy', $cat->id) }}"
                                                    onsubmit="return confirm('Hapus kategori {{ $cat->name }}?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="w-8 h-8 rounded-lg bg-surface-container-low hover:bg-error-container text-error flex items-center justify-center transition-colors">
                                                        <span
                                                            class="material-symbols-outlined text-[18px]">delete</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-space-lg py-12 text-center">
                                            <span class="material-symbols-outlined text-[40px] text-outline">sell</span>
                                            <p class="font-body-md text-secondary mt-2">Belum ada kategori. Tambahkan
                                                lewat form di samping.</p>
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

    {{-- MODAL EDIT KATEGORI --}}
    <div id="editModal"
        class="fixed inset-0 z-[60] hidden bg-inverse-surface/60 backdrop-blur-sm flex items-center justify-center p-margin">
        <div class="w-full max-w-md bg-surface-container-lowest rounded-2xl shadow-2xl p-space-xl">
            <h3 class="font-headline-md text-on-surface mb-space-md flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-[22px]">edit</span>
                <span>Edit Kategori</span>
            </h3>
            <form method="POST" id="editForm" class="flex flex-col gap-space-md">
                @csrf
                @method('PUT')
                <div class="flex flex-col gap-space-xs">
                    <label class="font-label-md text-on-surface-variant">Nama Kategori</label>
                    <input type="text" id="editName" name="name" required maxlength="100"
                        class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-on-surface font-body-md outline-none focus:ring-2 focus:ring-primary-container" />
                </div>
                <div class="flex items-center justify-end gap-space-sm">
                    <button type="button" id="closeModal"
                        class="px-4 py-2 rounded-lg bg-surface-container-low hover:bg-surface-container text-on-surface font-label-md transition-colors">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 rounded-lg bg-primary-container hover:bg-primary text-on-primary font-label-md font-bold shadow-sm transition-all">Simpan
                        Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('editModal');
        const editForm = document.getElementById('editForm');
        const editName = document.getElementById('editName');

        document.querySelectorAll('[data-edit-id]').forEach(btn => {
            btn.addEventListener('click', () => {
                editForm.action = '/admin/categories/' + btn.dataset.editId;
                editName.value = btn.dataset.editName;
                modal.classList.remove('hidden');
            });
        });

        document.getElementById('closeModal').addEventListener('click', () => modal.classList.add('hidden'));
        modal.addEventListener('click', e => {
            if (e.target === modal) modal.classList.add('hidden');
        });
    </script>

</body>

</html>
