<div x-data="{ showButton: false }"
    x-init="window.addEventListener('scroll', () => { showButton = window.pageYOffset > 500 })"
    class="fixed bottom-24 right-4 md:bottom-8 md:right-8 z-50">
    <button
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        x-show="showButton"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-8"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-8"
        class="bg-primary-500/70 hover:bg-primary-500 text-secondary-500/80 p-3 rounded-2xl shadow-lg hover:shadow-xl transform hover:scale-110 transition-all duration-300"
        aria-label="Volver arriba">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 md:h-6 w-4 md:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </button>
</div>
