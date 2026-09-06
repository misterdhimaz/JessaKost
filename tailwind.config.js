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
            colors: {
                jessa: {
                    cream: '#FBF3D5',
                    creamDark: '#F2E8C4',
                    maroon: '#92003A',
                    maroonLight: '#B00047',
                    maroonDark: '#6B002A',
                    dark: '#1A1A1A',
                }
            },
            fontFamily: {
                sans: ['Plus Jakarta Sans', 'sans-serif'],
            }
        },
    },

    plugins: [forms],
};
