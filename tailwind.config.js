import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                shine: {
                    '100%': { transform: 'translateX(150%) skew-x-[-20deg]' }
                }
            },
            animation: {
                shine: 'shine 1s ease-in-out infinite'
            }
        },
    },

    plugins: [forms],
};
