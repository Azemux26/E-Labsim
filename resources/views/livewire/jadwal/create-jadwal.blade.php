<div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">
                Form Pengajuan Jadwal Lab/Simulator
            </h1>
            <p class="text-zinc-600 dark:text-zinc-400 mt-2">
                Isi form berikut untuk mengajukan penggunaan laboratorium atau simulator
            </p>
        </div>

        <!-- Form -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6">
            <form wire:submit.prevent="save">

                <!-- Lab & Simulator -->
                <div class="mb-6">
                    <label for="lab_simulator_id" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                        Lab & Simulator *
                    </label>
                    <select wire:model="lab_simulator_id" id="lab_simulator_id"
                        class="w-full rounded-lg border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-700
                               text-zinc-900 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                        required>
                        <option value="">-- Pilih Lab/Simulator --</option>
                        @foreach ($labSimulators as $lab)
                            <option value="{{ $lab->id }}">
                                {{ $lab->name }} - {{ ucfirst($lab->type) }}
                            </option>
                        @endforeach
                    </select>
                    @error('lab_simulator_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tanggal & Jam -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

                    <div>
                        <label for="tanggal" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                            Tanggal *
                        </label>
                        <input type="date" wire:model="tanggal" id="tanggal" min="{{ date('Y-m-d') }}"
                            class="w-full rounded-lg border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-700
                                   text-zinc-900 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                            required>
                        @error('tanggal')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="jam_mulai" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                            Jam Mulai *
                        </label>
                        <input type="time" wire:model="jam_mulai" id="jam_mulai"
                            class="w-full rounded-lg border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-700
                                   text-zinc-900 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                            required>
                        @error('jam_mulai')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="jam_selesai"
                            class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                            Jam Selesai *
                        </label>
                        <input type="time" wire:model="jam_selesai" id="jam_selesai"
                            class="w-full rounded-lg border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-700
                                   text-zinc-900 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                            required>
                        @error('jam_selesai')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Informasi Pengguna -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                            Nama {{ auth()->user()->role->name === 'ka.lab' ? 'Ka.Lab' : 'Pengajar' }}
                        </label>
                        <input type="text" value="{{ auth()->user()->name }}" readonly
                            class="w-full rounded-lg border-zinc-300 dark:border-zinc-600 bg-zinc-100 dark:bg-zinc-600
                                   text-zinc-900 dark:text-white">
                    </div>
                    <div>
                        <label for="no_whatsapp"
                            class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                            No. WhatsApp *
                        </label>
                        <input type="text" wire:model="no_whatsapp" id="no_whatsapp"
                            class="w-full rounded-lg border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-700
                                   text-zinc-900 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                            placeholder="628123456789" required>
                        @error('no_whatsapp')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Nama Pengajar -->
                @if (auth()->user()->role->name === 'ka.lab')
                    <div class="mb-6">
                        <label for="pengajar_id"
                            class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                            Nama Pengajar *
                        </label>

                        <select wire:model="pengajar_id" id="pengajar_id"
                            class="w-full rounded-lg border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-700
                   text-zinc-900 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                            required>
                            <option value="">-- Pilih / Tulis Nama Pengajar --</option>
                            @foreach ($pengajarList as $pengajar)
                                <option value="{{ $pengajar->id }}">{{ $pengajar->name }}</option>
                            @endforeach
                            <option value="{{ auth()->id() }}">{{ auth()->user()->name }} (Saya Sendiri)</option>
                        </select>

                        @error('pengajar_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @endif
                <!-- Jenis Kegiatan -->
                <div class="mb-6">
                    <label for="jenis_kegiatan" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                        Jenis Kegiatan *
                    </label>
                    <input type="text" wire:model="jenis_kegiatan" id="jenis_kegiatan"
                        class="w-full rounded-lg border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-700
                               text-zinc-900 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Contoh: Praktikum Jaringan Komputer, Simulasi Navigasi, dll." required>
                    @error('jenis_kegiatan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Detail Materi -->
                <div class="mb-6">
                    <label for="detail_materi" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                        Detail Materi *
                    </label>
                    <textarea wire:model="detail_materi" id="detail_materi" rows="4"
                        class="w-full rounded-lg border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-700
                               text-zinc-900 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Jelaskan secara detail materi yang akan diajarkan..." required></textarea>
                    @error('detail_materi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jumlah Peserta -->
                <div class="mb-6">
                    <label for="jumlah_peserta" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                        Jumlah Peserta *
                    </label>
                    <input type="number" wire:model="jumlah_peserta" id="jumlah_peserta" min="1"
                        class="w-full rounded-lg border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-700
                               text-zinc-900 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                        placeholder="0" required>
                    @error('jumlah_peserta')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="flex gap-3 pt-4 border-t border-zinc-200 dark:border-zinc-700">
                    <flux:button type="button" :href="route('dashboard')" wire:navigate class="gap-2">
                        <span>←</span> Kembali
                    </flux:button>

                    <flux:button type="submit" variant="primary" class="gap-2">
                        <span>📅</span> Ajukan Jadwal
                    </flux:button>
                </div>
            </form>
        </div>
    </div>
    {{-- <!-- SweetAlert2 CDN -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- SweetAlert2 Script -->
    <script>
        document.addEventListener('livewire:load', () => {
            Livewire.on('show-success', (event) => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: event.message,
                    timer: 3000
                });
            });

            Livewire.on('show-error', (event) => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: event.message
                });
            });
        });
    </script> --}}

</div>
