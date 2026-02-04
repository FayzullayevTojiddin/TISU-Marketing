<x-filament-panels::page>
    <form wire:submit.prevent>
        {{ $this->form }}
    </form>

    <div class="mt-6">
        <x-filament::section>
            <div class="text-center">
                <p class="text-sm text-gray-500">{{ $this->getFilterLevel() }}</p>
                <p class="text-4xl font-bold text-primary-600">{{ $this->getStudentCount() }}</p>
            </div>
        </x-filament::section>
    </div>
</x-filament-panels::page>
