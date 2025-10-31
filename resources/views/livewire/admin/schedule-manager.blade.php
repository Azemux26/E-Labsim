<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-semibold text-zinc-900 dark:text-white">📅 Kelola Jadwal (Schedule Manager)</h2>
        <!-- Tombol Export -->
        <div class="flex gap-2">
            <button wire:click="exportPdf" style="color: white !important; background-color: #dc2626 !important;"
                class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold shadow-md">
                ⬇️ Export PDF
            </button>

            <button wire:click="exportExcel" style="color: white !important; background-color: #16a34a !important;"
                class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold shadow-md">
                ⬇️ Export Excel
            </button>
        </div>
    </div>

    <div
        class="flex flex-wrap items-center gap-3 p-4 border border-zinc-200 rounded-lg bg-white dark:bg-zinc-800 dark:border-zinc-700">
        <div class="flex-1 min-w-[180px]">
            <input type="text" wire:model.live="search" placeholder="Cari berdasarkan nama pengajar..."
                class="w-full rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white  text-zinc-900 dark:text-zinc-100 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <select wire:model.live="filterTahun"
                class="rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white  text-zinc-900 dark:text-zinc-100 px-3 py-2 text-sm">
                <option value="">-- Semua Tahun --</option>
                @foreach (range(date('Y'), 2020) as $tahun)
                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <select wire:model.live="filterLab"
                class="rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white  text-zinc-900 dark:text-zinc-100 px-3 py-2 text-sm">
                <option value="">-- Semua Lab --</option>
                @foreach ($labs as $lab)
                    <option value="{{ $lab->id }}">{{ $lab->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- PERBAIKAN DI SINI: Container tabel yang melebar penuh -->
    <div
        class="w-full overflow-x-auto rounded-lg border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800">
        <table class="w-full border-collapse text-sm">
            <thead class="bg-gray-100 dark:bg-zinc-800">
                <tr>
                    <th class="px-4 py-3 border-b text-center w-12">No</th>
                    <th class="px-4 py-3 border-b w-32 text-center">Tanggal</th>
                    <th class="px-4 py-3 border-b w-40">Jam</th>
                    <th class="px-4 py-3 border-b w-40">Pengajar</th>
                    <th class="px-4 py-3 border-b w-40">Ka.Lab</th>
                    <th class="px-4 py-3 border-b w-48">Lab/Simulator</th>
                    <th class="px-4 py-3 border-b min-w-48 flex-1">Kegiatan</th>
                    <th class="px-4 py-3 border-b w-24 text-center">Peserta</th>
                    <th class="px-4 py-3 border-b w-32 text-center">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-zinc-700">
                @forelse($schedules as $i => $s)
                    <tr class=" dark:hover:bg-zinc-700">
                        <td class="px-4 py-3 text-center">{{ $i + 1 }}</td>
                        <td class="px-4 py-3 text-center">{{ optional($s->tanggal)->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-center">{{ $s->jam_mulai }} - {{ $s->jam_selesai }}</td>
                        <td class="px-4 py-3 text-center">{{ $s->pengajar->name ?? '-' }}</td>
                        <td class="px-4 py-3 text-center">{{ $s->kalab->name ?? '-' }}</td>
                        <td class="px-4 py-3 text-center">{{ $s->labSimulator->name ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $s->jenis_kegiatan ?? ($s->kegiatan ?? '-') }}</td>
                        <td class="px-4 py-3 text-center">{{ $s->jumlah_peserta }}</td>
                        <td class="px-4 py-3 text-center">
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full 
                                {{ $s->status_verifikasi == 'Disetujui' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $s->status_verifikasi }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-4 text-zinc-500">Tidak ada data jadwal</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $schedules->links() }}
    </div>
</div>
