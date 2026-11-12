@include('petugas.petugas-head', ['title' => 'Perpanjangan'])

<body class="bg-background font-body-md text-on-surface antialiased">

    @include('partials.petugas-sidebar')

    <div class="lg:pl-72 flex flex-col min-h-screen">
        @include('petugas.petugas-header', ['page' => 'Perpanjangan'])

        <main class="pt-16 w-full flex-1 px-margin-tablet py-space-xl bg-background">
            <div class="flex flex-col w-full gap-space-lg">

                <div class="p-4 rounded-xl bg-secondary-fixed text-on-secondary-fixed flex items-center gap-2 font-body-sm">
                    <span class="material-symbols-outlined">info</span>
                    <span>Petugas memantau ajuan perpanjangan di sini. <strong>Persetujuan/penolakan dilakukan oleh Admin (Pengelola)</strong> sesuai alur persetujuan berlapis.</span>
                </div>

                <div class="bg-surface-container-lowest rounded-2xl shadow-sm p-space-lg flex flex-col gap-space-md">
                    <div>
                        <h2 class="font-headline-md text-headline-md text-on-surface flex items-center gap-2">
                            Ajuan Perpanjangan
                            <span class="px-2.5 py-0.5 rounded-full bg-surface-container text-on-surface-variant font-label-sm">{{ $extensions->count() }} Ajuan</span>
                        </h2>
                        <p class="font-body-sm text-on-surface-variant mt-1">Riwayat pengajuan perpanjangan masa pinjam anggota</p>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-surface-container-low/70 text-on-surface-variant font-label-sm uppercase">
                                    <th class="py-space-md px-space-md">Peminjam</th>
                                    <th class="py-space-md px-space-md">Judul Buku</th>
                                    <th class="py-space-md px-space-md">Tempo Saat Ini</th>
                                    <th class="py-space-md px-space-md">Diajukan</th>
                                    <th class="py-space-md px-space-md">Status</th>
                                </tr>
                            </thead>
                            <tbody class="font-body-md text-on-surface">
                                @forelse($extensions as $ext)
                                    <tr class="border-t border-outline-variant/30 hover:bg-surface-container-low/40 transition-colors">
                                        <td class="py-space-md px-space-md font-label-md">{{ $ext->borrower_name }}</td>
                                        <td class="py-space-md px-space-md">{{ $ext->book_title }}</td>
                                        <td class="py-space-md px-space-md text-body-sm whitespace-nowrap">
                                            {{ $ext->current_due ? \Carbon\Carbon::parse($ext->current_due)->format('d M Y') : '-' }}
                                        </td>
                                        <td class="py-space-md px-space-md text-body-sm whitespace-nowrap">
                                            {{ $ext->created_at ? \Carbon\Carbon::parse($ext->created_at)->format('d M Y') : '-' }}
                                        </td>
                                        <td class="py-space-md px-space-md">
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm font-bold">
                                                {{ ucfirst($ext->status ?? '-') }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="py-10 text-center text-secondary font-body-md">Belum ada ajuan perpanjangan.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>

</html>