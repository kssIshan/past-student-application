import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'rc-purple-heart': '#673AB7',
                'rc-white': '#FFF',
                'rc-atlantis': '#92dd32',
                'rc-java': '#27afc2',
                'rc-selective-yellow': '#fbbc04',
                'rc-royal-blue': '#4285F4',
                'rc-seashell': '#F1F1F1',
                'rc-eastern-blue': '#1A93B9',
                'rc-lily-white': '#E7FBFF',
                'rc-nobel': '#B1B1B1',
                'rc-cod-gray': '#0b0b0b',
                'rc-gunsmoke': '#858585',
                'rc-bondi-blue': '#0d9aae',
                'rc-bondi-blue2': '#0b8a9c',


            }
        },
    },

    plugins: [forms],
};
