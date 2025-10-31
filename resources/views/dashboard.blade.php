<!-- resources/views/dashboard.blade.php -->
<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        
        @php
            $user = auth()->user();
            $role = $user->role;
            $roleName = $role ? $role->name : 'unknown';
        @endphp

        <!-- HEADER BERDASARKAN ROLE -->
        <div class="flex flex-col gap-2">
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">
                @if($roleName === 'admin')
                    🛠️ Admin Dashboard
                @elseif($roleName === 'pengajar')
                    👨‍🏫 Dashboard Pengajar  
                @elseif($roleName === 'ka.lab')
                    🔬 Dashboard Ka.Lab
                @else
                    📊 Dashboard
                @endif
            </h1>
            <p class="text-zinc-600 dark:text-zinc-400">
                Selamat datang, {{ $user->name }}!
            </p>
        </div>

        <!-- CONTENT BERDASARKAN ROLE -->
        @if($roleName === 'admin')
            <!-- ==================== ADMIN DASHBOARD ==================== -->
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                <!-- Total Users Card -->
                <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-900/20">
                            <span class="text-xl">👥</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Total Users</p>
                            <p class="text-2xl font-semibold text-zinc-900 dark:text-white">{{ \App\Models\User::count() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Pending Schedules Card -->
                <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-yellow-100 dark:bg-yellow-900/20">
                            <span class="text-xl">⏳</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Menunggu Verifikasi</p>
                            <p class="text-2xl font-semibold text-zinc-900 dark:text-white">{{ \App\Models\LabSchedule::where('status_verifikasi', 'Belum Disetujui')->count() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Approved Schedules Card -->
                <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-green-100 dark:bg-green-900/20">
                            <span class="text-xl">✅</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Jadwal Disetujui</p>
                            <p class="text-2xl font-semibold text-zinc-900 dark:text-white">{{ \App\Models\LabSchedule::where('status_verifikasi', 'Disetujui')->count() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Labs Card -->
                <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-purple-100 dark:bg-purple-900/20">
                            <span class="text-xl">🔬</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Total Lab/Simulator</p>
                            <p class="text-2xl font-semibold text-zinc-900 dark:text-white">{{ \App\Models\LabSimulator::count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions & Recent Activity -->
            <div class="grid gap-6 lg:grid-cols-2">
                <!-- Quick Actions -->
                <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <flux:button :href="route('admin.users')" variant="outline" class="w-full justify-start gap-3" wire:navigate>
                            <span class="text-lg">📊</span>
                            Kelola Users
                        </flux:button>
                        <flux:button :href="route('admin.jadwal')" variant="outline" class="w-full justify-start gap-3" wire:navigate>
                            <span class="text-lg">📅</span>
                            Kelola Jadwal
                        </flux:button>
                        <flux:button :href="route('admin.labs')" variant="outline" class="w-full justify-start gap-3" wire:navigate>
                            <span class="text-lg">🔬</span>
                            Kelola Lab & Simulator
                        </flux:button>
                    </div>
                </div>
                
                <!-- Recent Activity -->
                <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4">Recent Activity</h3>
                    <div class="space-y-3">
                        @php
                            $recentSchedules = \App\Models\LabSchedule::with(['labSimulator', 'pengajar'])
                                ->latest()
                                ->take(3)
                                ->get();
                        @endphp
                        
                        @forelse($recentSchedules as $schedule)
                            <div class="flex items-center justify-between rounded-lg border border-zinc-200 bg-zinc-50 p-3 dark:border-zinc-700 dark:bg-zinc-800/50">
                                <div class="flex-1">
                                    <p class="font-medium text-zinc-900 dark:text-white">
                                        {{ $schedule->labSimulator->name ?? 'N/A' }}
                                    </p>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400">
                                        {{ $schedule->pengajar->name ?? 'Tidak ada pengajar' }} • {{ $schedule->tanggal->format('d/m/Y') }}
                                    </p>
                                </div>
                                <span class="px-2 py-1 text-xs font-medium rounded-full 
                                    {{ $schedule->status_verifikasi == 'Disetujui' ? 
                                       'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 
                                       'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' }}">
                                    {{ $schedule->status_verifikasi }}
                                </span>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <p class="text-zinc-500 dark:text-zinc-400">Belum ada jadwal</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        @elseif($roleName === 'pengajar')
            <!-- ==================== PENGAJAR DASHBOARD ==================== -->
            <div class="grid gap-6 md:grid-cols-3">
                <!-- Jadwal Saya Card -->
                <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-900/20">
                            <span class="text-xl">📅</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Jadwal Saya</p>
                            <p class="text-2xl font-semibold text-zinc-900 dark:text-white">{{ $user->labschedulesAsPengajar()->count() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Disetujui Card -->
                <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-green-100 dark:bg-green-900/20">
                            <span class="text-xl">✅</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Disetujui</p>
                            <p class="text-2xl font-semibold text-zinc-900 dark:text-white">{{ $user->labschedulesAsPengajar()->where('status_verifikasi', 'Disetujui')->count() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Menunggu Card -->
                <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-yellow-100 dark:bg-yellow-900/20">
                            <span class="text-xl">⏳</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Menunggu</p>
                            <p class="text-2xl font-semibold text-zinc-900 dark:text-white">{{ $user->labschedulesAsPengajar()->where('status_verifikasi', 'Belum Disetujui')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Action -->
            <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                <flux:button :href="route('jadwal.create')" variant="primary" class="gap-2" wire:navigate>
                    <span>➕</span>
                    Buat Jadwal Baru
                </flux:button>
            </div>

        @elseif($roleName === 'ka.lab')
            <!-- ==================== KA.LAB DASHBOARD ==================== -->
            <div class="grid gap-6 md:grid-cols-3">
                <!-- Jadwal Lab Saya Card -->
                <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-900/20">
                            <span class="text-xl">🔬</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Jadwal Lab Saya</p>
                            <p class="text-2xl font-semibold text-zinc-900 dark:text-white">{{ $user->labschedulesAsKalab()->count() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Disetujui Card -->
                <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-green-100 dark:bg-green-900/20">
                            <span class="text-xl">✅</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Disetujui</p>
                            <p class="text-2xl font-semibold text-zinc-900 dark:text-white">{{ $user->labschedulesAsKalab()->where('status_verifikasi', 'Disetujui')->count() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Menunggu Card -->
                <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-yellow-100 dark:bg-yellow-900/20">
                            <span class="text-xl">⏳</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Menunggu</p>
                            <p class="text-2xl font-semibold text-zinc-900 dark:text-white">{{ $user->labschedulesAsKalab()->where('status_verifikasi', 'Belum Disetujui')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Action -->
            <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-800">
                <flux:button :href="route('jadwal.create')" variant="primary" class="gap-2" wire:navigate>
                    <span>➕</span>
                    Buat Jadwal Lab Baru
                </flux:button>
            </div>

        @else
            <!-- ==================== DEFAULT/FALLBACK ==================== -->
            <div class="rounded-xl border border-red-200 bg-red-50 p-6 dark:border-red-800 dark:bg-red-900/20">
                <div class="flex items-center gap-3">
                    <span class="text-red-600 dark:text-red-400">⚠️</span>
                    <div>
                        <h3 class="font-medium text-red-800 dark:text-red-300">Role Tidak Ditemukan</h3>
                        <p class="text-sm text-red-700 dark:text-red-400 mt-1">
                            User ID: {{ $user->id }} tidak memiliki role. Silakan hubungi administrator.
                            <br>Role ID: {{ $user->role_id ?? 'NULL' }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

    </div>
</x-layouts.app>