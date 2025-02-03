<div class="relative inline-block text-left mr-4">
    <div class="flex space-x-4">
        <button type="button"
                wire:click="switchLanguage('es')"
                wire:loading.attr="disabled"
                class="text-gray-200 hover:text-gray-700 {{ $currentLocale === 'es' ? 'font-bold' : '' }}">
            ES
        </button>
        <button type="button"
                wire:click="switchLanguage('en')"
                wire:loading.attr="disabled"
                class="text-gray-200 hover:text-gray-700 {{ $currentLocale === 'en' ? 'font-bold' : '' }}">
            EN
        </button>
    </div>
</div>
