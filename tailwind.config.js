import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    future: {
        /* hover: variants only on devices with real pointers — touch taps no longer
           trigger sticky hover states */
        hoverOnlyWhenSupported: true,
    },

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                /* ── Legacy cyber-purple (keep for existing views) ── */
                'cyber-purple': {
                    50: '#f5f0ff',
                    100: '#ede4ff',
                    200: '#dcc9ff',
                    300: '#c1a1ff',
                    400: '#a36dff',
                    500: '#8c2bee',
                    600: '#7a1cd1',
                    700: '#6616ad',
                    800: '#55158c',
                    900: '#471374',
                },
                'cyber-dark': {
                    900: '#0f0a1a',
                    800: '#1a132e',
                    700: '#2a1e4a',
                },
                /* ── University palette (morado institucional UTP) ── */
                'uni-purple': {
                    50:  '#faf4fb',
                    100: '#f3e4f5',
                    200: '#e5c6ea',
                    300: '#d3a0dc',
                    400: '#b96cc8',
                    500: '#9c44ab',
                    600: '#7f2c8e',
                    700: '#672372',
                    800: '#4a1853',
                    900: '#341138',
                    950: '#1f0922',
                },
                'uni-gold': {
                    50:  '#fdf9ec',
                    100: '#faedbe',
                    200: '#f5d878',
                    300: '#f0c332',
                    400: '#d9a820',
                    500: '#b88c16',
                    600: '#8f6c0e',
                    700: '#664c08',
                    800: '#3d2d04',
                    900: '#1a1202',
                },
                'uni-cream': {
                    50:  '#fdfcf8',
                    100: '#faf7ef',
                    200: '#f3ecda',
                    300: '#e8dcc0',
                    400: '#d4c490',
                    500: '#b8a86a',
                },
            },
            fontFamily: {
                sans:  ['Inter', 'Space Grotesk', ...defaultTheme.fontFamily.sans],
                serif: ['Playfair Display', ...defaultTheme.fontFamily.serif],
            },
            backdropBlur: {
                xs: '2px',
            },
            transitionTimingFunction: {
                /* Strong curves — built-in CSS easings are too weak for UI motion */
                'out-strong':    'cubic-bezier(0.23, 1, 0.32, 1)',
                'in-out-strong': 'cubic-bezier(0.77, 0, 0.175, 1)',
            },
            transitionDuration: {
                250: '250ms',
            },
            keyframes: {
                blob: {
                    '0%':   { transform: 'translate(0px, 0px) scale(1)' },
                    '33%':  { transform: 'translate(30px, -50px) scale(1.1)' },
                    '66%':  { transform: 'translate(-20px, 20px) scale(0.9)' },
                    '100%': { transform: 'translate(0px, 0px) scale(1)' },
                },
                'fade-in-up': {
                    '0%':   { opacity: '0', transform: 'translateY(28px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                'fade-in': {
                    '0%':   { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                'slide-in-left': {
                    '0%':   { opacity: '0', transform: 'translateX(-32px)' },
                    '100%': { opacity: '1', transform: 'translateX(0)' },
                },
                'float-y': {
                    '0%, 100%': { transform: 'translateY(0px)' },
                    '50%':      { transform: 'translateY(-14px)' },
                },
                'draw-width': {
                    '0%':   { width: '0%' },
                    '100%': { width: '100%' },
                },
                'shimmer': {
                    '0%':   { backgroundPosition: '-200% center' },
                    '100%': { backgroundPosition: '200% center' },
                },
                'spin-very-slow': {
                    '0%':   { transform: 'rotate(0deg)' },
                    '100%': { transform: 'rotate(360deg)' },
                },
                'pulse-ring': {
                    '0%':   { transform: 'scale(0.95)', opacity: '0.6' },
                    '50%':  { transform: 'scale(1.05)', opacity: '0.3' },
                    '100%': { transform: 'scale(0.95)', opacity: '0.6' },
                },
                'counter-pop': {
                    '0%':   { transform: 'scale(1)' },
                    '50%':  { transform: 'scale(1.06)' },
                    '100%': { transform: 'scale(1)' },
                },
            },
            animation: {
                blob:            'blob 7s infinite',
                'fade-in-up':    'fade-in-up 0.7s cubic-bezier(0.16, 1, 0.3, 1) both',
                'fade-in':       'fade-in 0.6s ease-out both',
                'slide-in-left': 'slide-in-left 0.7s cubic-bezier(0.16, 1, 0.3, 1) both',
                'float-y':       'float-y 4s ease-in-out infinite',
                'draw-width':    'draw-width 0.9s ease-out both',
                'shimmer':       'shimmer 2.5s linear infinite',
                'spin-very-slow':'spin-very-slow 30s linear infinite',
                'pulse-ring':    'pulse-ring 3s ease-in-out infinite',
                'counter-pop':   'counter-pop 0.3s ease-out',
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('tailwindcss-animate'),
    ],
};
