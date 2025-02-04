<div class="relative inline-block text-left mr-4">
    <div class="flex space-x-4">
        @foreach($locales as $code => $name)
            <button type="button"
                    wire:click="switchLanguage('{{ $code }}')"
                    wire:loading.attr="disabled"
                    class="text-gray-200 hover:text-violet-400 {{ $currentLocale === $code ? 'font-bold text-violet-400' : '' }}">
                {{ strtoupper($code) }}
            </button>
        @endforeach
    </div>
</div>
