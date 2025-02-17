<div>
    <div class="flex items-center justify-center space-x-2">
        @foreach($locales as $code => $name)
            <button 
                wire:click="switchLanguage('{{ $code }}')"
                class="px-2 py-1 text-sm {{ $currentLocale === $code ? 'text-primary-500 font-bold' : 'text-gray-500 hover:text-primary-500' }}"
            >
                {{ strtoupper($code) }}
            </button>
            @if(!$loop->last)
                <span class="text-gray-300">|</span>
            @endif
        @endforeach
    </div>
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('redirect-to', (event) => {
                window.location.href = event.path;
            });
        });
    </script>
</div>
