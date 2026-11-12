@include('petugas.petugas-head', ['title' => 'Antrean FIFO'])

<body class="bg-background font-body-md text-on-surface antialiased">

    @include('partials.petugas-sidebar')

    <div class="lg:pl-72 flex flex-col min-h-screen">
        @include('petugas.petugas-header', ['page' => 'Antrean FIFO'])

        <main class="pt-16 w-full flex-1 px-margin-tablet py-space-xl bg-background">
            <div class="flex flex-col w-full gap-space-lg">

                <div class="p-4 rounded-xl bg-primary-fixed text-on-primary-fixed flex items-center gap-2 font-body-sm">
                    <span class="material-symbols-outlined">info</span>
                    <span>Urutan antrean dihitung otomatis dari waktu masuk (First-In-First-Out). Posisi #1 wajib dilayani lebih dulu saat stok kembali tersedia.</span>
                </div>

                @forelse($queues as $bookId => $items)
                    @php $first = $items->first(); @endphp
                    <div class="bg-surface-container-lowest rounded-2xl shadow-sm p-space-lg flex flex-col gap-space-md">
                        <div class="flex items-center justify-between flex-wrap gap-space-sm">
                            <div>
                                <h2 class="font-headline-md text-headline-md text-on-surface">{{ $first->book_title }}</h2>
                                <p class="font-body-sm text-on-surface-variant mt-1">{{ $items->count() }} orang dalam antrean</p>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full font-label-sm font-bold {{ $first->book_stock > 0 ? 'bg-tertiary-fixed text-on-tertiary-fixed' : 'bg-error-container text-on-error-container' }}">
                                <span class="material-symbols-outlined text-[15px]">inventory_2</span>
                                Stok: {{ $first->book_stock }}
                            </span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-surface-container-low/70 text-on-surface-variant font-label-sm uppercase">
                                        <th class="py-space-md px-space-md">Posisi</th>
                                        <th class="py-space-md px-space-md">Anggota</th>
                                        <th class="py-space-md px-space-md">Waktu Antre</th>
                                        <th class="py-space-md px-space-md">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody class="font-body-md text-on-surface">
                                    @foreach($items as $q)
                                        <tr class="border-t border-outline-variant/30 hover:bg-surface-container-low/40 transition-colors">
                                            <td class="py-space-md px-space-md">
                                                <span class="w-8 h-8 rounded-full flex items-center justify-center font-bold font-label-md {{ $loop->first ? 'bg-primary-container text-on-primary' : 'bg-surface-container text-on-surface-variant' }}">
                                                    #{{ $loop->iteration }}
                                                </span>
                                            </td>
                                            <td class="py-space-md px-space-md font-label-md">{{ $q->user_name }}</td>
                                            <td class="py-space-md px-space-md text-body-sm whitespace-nowrap">
                                                {{ \Carbon\Carbon::parse($q->created_at)->locale('id')->isoFormat('D MMM Y, HH:mm') }}
                                            </td>
                                            <td class="py-space-md px-space-md">
                                                @if ($loop->first)
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-label-sm font-bold">
                                                        <span class="material-symbols-outlined text-[14px]">priority_high</span> Prioritas Berikutnya
                                                    </span>
                                                @else
                                                    <span class="font-label-sm text-outline">Menunggu giliran</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @empty
                    <div class="bg-surface-container-lowest rounded-2xl shadow-sm p-space-xl text-center">
                        <span class="material-symbols-outlined text-[48px] text-outline block mb-2">hourglass_empty</span>
                        <p class="font-body-md text-secondary">Tidak ada antrean aktif. Semua koleksi tersedia atau belum ada yang mengantre.</p>
                    </div>
                @endforelse

            </div>
        </main>
    </div>

</body>

</html>