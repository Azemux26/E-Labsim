<div class="p-6">
    <!-- Header -->
    <div class="mb-6 p-4">
        <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">
            {{ $roleName === 'ka.lab' ? '🔬 Jadwal Lab Saya' : '📅 Jadwal Pengajaran Saya' }}
        </h1>
        <p class="text-zinc-600 dark:text-zinc-300">
            Daftar semua jadwal
            {{ $roleName === 'ka.lab' ? 'yang dikelola oleh Anda sebagai Kepala Lab' : 'pengajaran Anda di laboratorium' }}.
        </p>
    </div>

    <!-- Kontainer utama -->
    <div class="flex flex-col gap-4 rounded-xl">
        <div
            class="rounded-xl border-2 border-blue-500 dark:border-yellow-500 bg-white dark:bg-zinc-900 overflow-hidden">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-black dark:text-white mb-4">
                    Daftar Jadwal {{ $roleName === 'ka.lab' ? 'Lab' : 'Saya' }}
                </h2>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b-2 border-blue-300 dark:border-yellow-300 bg-gray-100 dark:bg-zinc-800">
                                <th class="p-3 font-medium text-black dark:text-white">Lab / Simulator</th>
                                <th class="p-3 font-medium text-black dark:text-white">Tanggal</th>
                                <th class="p-3 font-medium text-black dark:text-white">Waktu</th>
                                @if ($roleName === 'ka.lab')
                                    <th class="p-3 font-medium text-black dark:text-white">Pengajar</th>
                                @elseif ($roleName === 'pengajar')
                                    <th class="p-3 font-medium text-black dark:text-white">Pengajar</th>
                                @endif
                                <th class="p-3 font-medium text-black dark:text-white">Kegiatan</th>
                                <th class="p-3 font-medium text-black dark:text-white">Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($schedules as $schedule)
                                <tr
                                    class="border-b border-gray-200 dark:border-zinc-700 hover:bg-gray-50 dark:hover:bg-zinc-800 transition">
                                    <td class="p-3 font-medium text-black dark:text-white">
                                        {{ $schedule->labSimulator->name ?? 'Tidak diketahui' }}
                                    </td>
                                    <td class="p-3 text-gray-700 dark:text-gray-300">
                                        {{ \Carbon\Carbon::parse($schedule->tanggal)->format('d/m/Y') }}
                                    </td>
                                    <td class="p-3 text-gray-700 dark:text-gray-300">
                                        {{ $schedule->jam_mulai }} - {{ $schedule->jam_selesai }}
                                    </td>
                                    <td class="p-3 text-gray-700 dark:text-gray-300">
                                        @if ($roleName === 'ka.lab')
                                            {{ $schedule->pengajar->name ?? ($schedule->kalab->name ?? 'Belum ada pengajar') }}
                                        @else
                                            {{ $schedule->kalab->name ?? ($schedule->pengajar->name ?? 'Belum ada Ka.Lab') }}
                                        @endif

                                    </td>
                                    <td class="p-3 text-gray-700 dark:text-gray-300">
                                        {{ $schedule->jenis_kegiatan ?? '-' }}
                                    </td>
                                    <td class="p-3">
                                        <span
                                            class="px-2 py-1 text-xs font-medium rounded-full
                                            {{ $schedule->status_verifikasi === 'Disetujui'
                                                ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200'
                                                : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' }}">
                                            {{ $schedule->status_verifikasi }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-8 text-center text-gray-500 dark:text-gray-400">
                                        <div class="flex flex-col items-center gap-2">
                                            <span class="text-4xl">📭</span>
                                            <p>Tidak ada jadwal ditemukan.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($schedules->hasPages())
                    <div class="mt-6 border-t border-gray-200 dark:border-zinc-700 pt-4">
                        {{ $schedules->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
