import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    '50': '#fff7f2',
                    '100': '#ffede4',
                    '200': '#ffd7c2',
                    '300': '#ffb78f',
                    '400': '#ff9659',
                    '500': '#ff7733', // Color base
                    '600': '#ff5c0d',
                    '700': '#cc4400',
                    '800': '#a63800',
                    '900': '#803000'
                },
                secondary: {
                    '50': '#f7f7f7',
                    '100': '#e3e3e3',
                    '200': '#c8c8c8',
                    '300': '#a4a4a4',
                    '400': '#636363',
                    '500': '#222222', // Color base
                    '600': '#1f1f1f',
                    '700': '#1c1c1c',
                    '800': '#181818',
                    '900': '#151515'
                },
                tertiary: {
                    '50': '#f6f6f7',
                    '100': '#e3e3e5',
                    '200': '#c7c8cc',
                    '300': '#a2a4aa',
                    '400': '#70737b',
                    '500': '#24272D', // Color base
                    '600': '#202329',
                    '700': '#1d1f24',
                    '800': '#191b20',
                    '900': '#16181c'
                },
                info: {
                    '50': '#eef7fb',
                    '100': '#dceff7',
                    '200': '#b9dfef',
                    '300': '#97cfe7',
                    '400': '#56BBDA', // Color base
                    '500': '#3eb3d6',
                    '600': '#2da8cd',
                    '700': '#2286a4',
                    '800': '#1b6b83',
                    '900': '#155062'
                },
                success: {
                    '50': '#f3f8ed',
                    '100': '#e7f1db',
                    '200': '#cfe3b7',
                    '300': '#b7d593',
                    '400': '#7FBF3B', // Color base
                    '500': '#72ac35',
                    '600': '#65992f',
                    '700': '#4c7324',
                    '800': '#3d5c1c',
                    '900': '#2e4515'
                },
                danger: {
                    '50': '#fbeaec',
                    '100': '#f7d4d9',
                    '200': '#efa9b3',
                    '300': '#e77e8d',
                    '400': '#C21F3B', // Color base
                    '500': '#af1c35',
                    '600': '#9b192f',
                    '700': '#741324',
                    '800': '#5d0f1c',
                    '900': '#460b15'
                },
                warning: {
                    '50': '#fcece6',
                    '100': '#fad9cc',
                    '200': '#f5b399',
                    '300': '#f08d66',
                    '400': '#E63600', // Color base
                    '500': '#cf3100',
                    '600': '#b82b00',
                    '700': '#8a2100',
                    '800': '#6e1a00',
                    '900': '#521400'
                }
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' }
                },
                fadeInDown: {
                    '0%': {
                        opacity: '0',
                        transform: 'translateY(-10px)'
                    },
                    '100%': {
                        opacity: '1',
                        transform: 'translateY(0)'
                    }
                },
                fadeInUp: {
                    '0%': {
                        opacity: '0',
                        transform: 'translateY(10px)'
                    },
                    '100%': {
                        opacity: '1',
                        transform: 'translateY(0)'
                    }
                }
            },
            animation: {
                fadeIn: 'fadeIn 0.5s ease-out',
                fadeInDown: 'fadeInDown 0.5s ease-out',
                fadeInUp: 'fadeInUp 0.5s ease-out'
            }
        }
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography')
    ]
}
