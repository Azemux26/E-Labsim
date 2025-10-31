<!-- resources/views/livewire/admin/user-management.blade.php -->
<div class="p-6">
    <!-- Header - TEST DARK MODE -->
    <div class="mb-6 p-4">
        <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">📊 Kelola Users</h1>
        <p class="text-zinc-600 dark:text-zinc-300">Management semua user e-LABSIM </p>
    </div>

    <!-- Content -->
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="rounded-xl border-2 border-blue-500 dark:border-yellow-500 bg-white dark:bg-zinc-900 overflow-hidden">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-black dark:text-white mb-4">Daftar User</h2>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b-2 border-blue-300 dark:border-yellow-300 bg-gray-100 dark:bg-zinc-800">
                                <th class="text-left p-3 font-medium text-black dark:text-white">Nama</th>
                                <th class="text-left p-3 font-medium text-black dark:text-white">Email</th>
                                <th class="text-left p-3 font-medium text-black dark:text-white">Role</th>
                                <th class="text-left p-3 font-medium text-black dark:text-white">WhatsApp</th>
                                <th class="text-left p-3 font-medium text-black dark:text-white">Tanggal Daftar</th>
                                <th class="text-left p-3 font-medium text-black dark:text-white">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr class="border-b border-gray-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 hover:bg-gray-50 dark:hover:bg-zinc-800 transition-colors">
                                    <td class="p-3 text-black dark:text-white font-medium">{{ $user->name }}</td>
                                    <td class="p-3 text-gray-700 dark:text-gray-300">{{ $user->email }}</td>
                                    <td class="p-3">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full 
                                            {{ $user->role->name === 'admin' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : 
                                               ($user->role->name === 'pengajar' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : 
                                               'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200') }}">
                                            {{ $user->role->name }}
                                        </span>
                                    </td>
                                    <td class="p-3 text-gray-700 dark:text-gray-300">{{ $user->no_whatsapp }}</td>
                                    <td class="p-3 text-gray-700 dark:text-gray-300">{{ $user->created_at->format('d/m/Y') }}</td>
                                    <td class="p-3">
                                        <div class="flex gap-2">
                                            <!-- Edit Button -->
                                            <button class="p-2 text-blue-600 hover:bg-blue-50 dark:text-blue-400 dark:hover:bg-blue-900/30 rounded-lg transition-colors"
                                                    title="Edit User">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </button>
                                            
                                            <!-- Delete Button -->
                                            <button class="p-2 text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/30 rounded-lg transition-colors"
                                                    title="Hapus User">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-8 text-center text-gray-500 dark:text-gray-400 bg-white dark:bg-zinc-900">
                                        <div class="flex flex-col items-center gap-2">
                                            <span class="text-4xl">👥</span>
                                            <p>Tidak ada user terdaftar</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($users->hasPages())
                <div class="mt-6 border-t border-gray-200 dark:border-zinc-700 pt-4">
                    {{ $users->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>