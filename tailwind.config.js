import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#6366f1',
                secondary: '#8b5cf6',
                accent: '#06b6d4',
            },
            animation: {
                'fade-in-up': 'fadeInUp 0.6s ease-out forwards',
                'fade-in-left': 'fadeInLeft 0.6s ease-out forwards',
                'pulse-glow': 'pulseGlow 2s ease-in-out infinite',
                'float': 'float 3s ease-in-out infinite',
                'shimmer': 'shimmer 2s linear infinite',
                'animate-float': 'float 3s ease-in-out infinite',
            },
            screens: {
                'xs': '475px',
            }
        },
    },

    plugins: [forms, typography],
};
