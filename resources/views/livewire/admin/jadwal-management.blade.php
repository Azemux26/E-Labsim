<!-- resources/views/livewire/admin/jadwal-management.blade.php -->
<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">📅 Kelola Jadwal</h1>
        <p class="text-gray-600 dark:text-gray-300">Approve atau reject jadwal lab & simulator</p>
    </div>

    <!-- Content -->
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="rounded-xl border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 overflow-hidden">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Daftar Jadwal</h2>
                
                <div class="space-y-4">
                    @forelse($schedules as $schedule)
                        <div class="border border-gray-200 dark:border-gray-600 rounded-lg p-4 hover:border-gray-300 dark:hover:border-gray-500 transition-colors bg-white dark:bg-gray-800 shadow-sm">
                            <div class="flex justify-between items-start gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <span class="text-xl">
                                            {{ ($schedule->labSimulator->type ?? 'lab') === 'lab' ? '🔬' : '🖥️' }}
                                        </span>
                                        <h3 class="font-semibold text-lg text-gray-900 dark:text-white">
                                            {{ $schedule->labSimulator->name ?? 'Lab/Simulator Tidak Ditemukan' }}
                                        </h3>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                                        <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300">
                                            <span>👨‍🏫</span>
                                            <span>{{ $schedule->pengajar->name ?? 'Tidak ada pengajar' }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300">
                                            <span>👨‍💼</span>
                                            <span>{{ $schedule->kalab->name ?? 'Tidak ada Ka.Lab' }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300">
                                            <span>📅</span>
                                            <span>{{ $schedule->tanggal->format('d/m/Y') }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300">
                                            <span>⏰</span>
                                            <span>{{ $schedule->jam_mulai }} - {{ $schedule->jam_selesai }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300">
                                            <span>👥</span>
                                            <span>{{ $schedule->jumlah_peserta }} peserta</span>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-900 dark:text-white">
                                            <strong class="text-gray-900 dark:text-white">Kegiatan:</strong> 
                                            <span class="text-gray-700 dark:text-gray-300">{{ $schedule->jenis_kegiatan }}</span>
                                        </p>
                                    </div>
                                    
                                    @if($schedule->detail_materi)
                                    <div class="mt-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600">
                                        <p class="text-sm text-gray-900 dark:text-white">
                                            <strong class="text-gray-900 dark:text-white">Materi:</strong> 
                                            <span class="text-gray-700 dark:text-gray-300">{{ $schedule->detail_materi }}</span>
                                        </p>
                                    </div>
                                    @endif

                                    <!-- Info Created By -->
                                    <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                        Diajukan oleh: {{ $schedule->createdBy->name ?? 'Unknown' }} • 
                                        {{ $schedule->created_at->format('d/m/Y H:i') }}
                                    </div>
                                </div>
                                
                                <div class="flex flex-col gap-2 items-end">
                                    <span class="px-3 py-1 text-sm rounded-full font-medium
                                        {{ $schedule->status_verifikasi == 'Disetujui' ? 
                                           'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 border border-green-200 dark:border-green-700' : 
                                           'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 border border-yellow-200 dark:border-yellow-700' }}">
                                        {{ $schedule->status_verifikasi }}
                                    </span>
                                    
                                    <div class="flex gap-2 mt-2">
                                        @if($schedule->status_verifikasi === 'Belum Disetujui')
                                            <button wire:click="approve({{ $schedule->id }})" 
                                                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm transition-colors flex items-center gap-2 shadow-sm">
                                                <span>✅</span>
                                                Approve
                                            </button>
                                        @else
                                            <button wire:click="reject({{ $schedule->id }})" 
                                                    class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg text-sm transition-colors flex items-center gap-2 shadow-sm">
                                                <span>⏳</span>
                                                Reject
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <div class="flex flex-col items-center gap-3">
                                <span class="text-6xl">📅</span>
                                <p class="text-gray-500 dark:text-gray-400 text-lg">Belum ada jadwal</p>
                                <p class="text-sm text-gray-400 dark:text-gray-500">Jadwal yang diajukan akan muncul di sini</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($schedules->hasPages())
                <div class="mt-6 border-t border-gray-200 dark:border-gray-600 pt-4">
                    {{ $schedules->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>


