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
                // Fonds
                nethraBlack: '#000000',
                nethraDark: '#0A0A14',
                nethraBlueDark: '#0F0F2F',
                nethraSteel: '#0F2F4F',
                nethraSignature: '#0F4F8F',
                nethraNeon: '#0F2F6F',

                // Accents / glow
                nethraAccent: '#4FA8FF',
                nethraHighlight: '#88CCFF',

                // Textes
                nethraWhite: '#FFFFFF',
                nethraLightGray: '#E0E6F0',
                nethraGrayBlue: '#A8B4C8',
                nethraGrayMedium: '#778199',

                // UI/UX
                success: '#2BBF81',
                warning: '#F2C94C',
                error: '#D8475B',
                info: '#4FA8FF',
            },
            boxShadow: {
                'nethra-glow': '0 0 12px rgba(79,168,255,0.45)',
                'nethra-glow-soft': '0 0 8px rgba(79,168,255,0.25)',
            },
        },
    },

    plugins: [forms],
};
