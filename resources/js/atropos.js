import Atropos from 'atropos';
import 'atropos/css';

// Función para inicializar Atropos en un elemento
const initAtropos = (el) => {
    return new Atropos({
        el,
        activeOffset: 40,
        shadowScale: 1.05,
        onEnter() {
            el.classList.add('atropos-active');
        },
        onLeave() {
            el.classList.remove('atropos-active');
        },
    });
};

// Función para inicializar todos los elementos Atropos
const initAllAtropos = () => {
    const elements = document.querySelectorAll('[data-atropos]');
    elements.forEach(el => {
        if (!el.atroposInstance) {
            el.atroposInstance = initAtropos(el);
        }
    });
};

// Inicializar cuando el DOM está listo
document.addEventListener('DOMContentLoaded', initAllAtropos);

// Inicializar cuando Livewire actualiza el DOM
document.addEventListener('livewire:navigated', initAllAtropos);
document.addEventListener('livewire:initialized', initAllAtropos);

// Limpiar instancias cuando Livewire reemplaza elementos
document.addEventListener('livewire:navigating', () => {
    const elements = document.querySelectorAll('[data-atropos]');
    elements.forEach(el => {
        if (el.atroposInstance) {
            el.atroposInstance.destroy();
            delete el.atroposInstance;
        }
    });
});
