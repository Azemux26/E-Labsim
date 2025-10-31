<x-layouts.auth.simple :title="$title ?? null">
    {{ $slot }}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Livewire Scripts -->
    @livewireScripts
</x-layouts.auth.simple>
