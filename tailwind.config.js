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
                primary: {
                    50: '#0a0e27',
                    100: '#0f1636',
                    200: '#141e45',
                    300: '#1a2654',
                    400: '#202e63',
                    500: '#263672',
                    600: '#2c3e81',
                    700: '#324690',
                    800: '#384e9f',
                    900: '#3e56ae',
                },
                secondary: {
                    50: '#00ff87',
                    100: '#00e678',
                    200: '#00cc69',
                    300: '#00b35a',
                    400: '#00994b',
                    500: '#00803c',
                    600: '#00662d',
                    700: '#004d1e',
                    800: '#00330f',
                    900: '#001a00',
                },
                accent: {
                    50: '#00d4ff',
                    100: '#00bfe6',
                    200: '#00aacc',
                    300: '#0095b3',
                    400: '#008099',
                    500: '#006b80',
                    600: '#005666',
                    700: '#00414d',
                    800: '#002c33',
                    900: '#00171a',
                },
                neon: {
                    blue: '#00f0ff',
                    purple: '#b000ff',
                    green: '#00ff87',
                    pink: '#ff00aa',
                    cyan: '#00ffff',
                },
                cyber: {
                    dark: '#0a0e27',
                    darker: '#050814',
                    light: '#1a2654',
                },
                gradient: {
                    start: '#0a0e27',
                    end: '#3e56ae',
                },
                gothic: {
                    blood: '#8B0000',
                    purple: '#4A0E4E',
                    deepPurple: '#2D1B4E',
                    crimson: '#DC143C',
                    black: '#0D0D0D',
                    dark: '#1A1A2E',
                },
                'accent-gold': '#D4AF37',
            },
            backgroundImage: {
                'gradient-primary': 'linear-gradient(135deg, #0a0e27 0%, #3e56ae 100%)',
                'gradient-secondary': 'linear-gradient(135deg, #00ff87 0%, #00662d 100%)',
                'gradient-accent': 'linear-gradient(135deg, #00d4ff 0%, #005666 100%)',
                'gradient-neon': 'linear-gradient(135deg, #00f0ff 0%, #b000ff 100%)',
                'gradient-cyber': 'linear-gradient(135deg, #0a0e27 0%, #1a2654 50%, #3e56ae 100%)',
                'gradient-dark': 'linear-gradient(135deg, #050814 0%, #0a0e27 50%, #1a2654 100%)',
                'gradient-gothic': 'linear-gradient(135deg, #1A1A2E 0%, #2D1B4E 50%, #4A0E4E 100%)',
            },
            animation: {
                'gradient-x': 'gradient-x 3s ease infinite',
                'float': 'float 3s ease-in-out infinite',
                'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                'glow': 'glow 2s ease-in-out infinite',
                'neon-pulse': 'neon-pulse 2s ease-in-out infinite',
                'gothic-pulse': 'gothic-pulse 3s ease-in-out infinite',
            },
            keyframes: {
                'gradient-x': {
                    '0%, 100%': {
                        'background-size': '200% 200%',
                        'background-position': 'left center'
                    },
                    '50%': {
                        'background-size': '200% 200%',
                        'background-position': 'right center'
                    },
                },
                'float': {
                    '0%, 100%': { transform: 'translateY(0px)' },
                    '50%': { transform: 'translateY(-10px)' },
                },
                'glow': {
                    '0%, 100%': { 
                        'box-shadow': '0 0 5px #00f0ff, 0 0 10px #00f0ff, 0 0 15px #00f0ff' 
                    },
                    '50%': { 
                        'box-shadow': '0 0 10px #00f0ff, 0 0 20px #00f0ff, 0 0 30px #00f0ff' 
                    },
                },
                'neon-pulse': {
                    '0%, 100%': { 
                        'opacity': '1',
                        'filter': 'brightness(1) drop-shadow(0 0 5px #00f0ff)'
                    },
                    '50%': { 
                        'opacity': '0.8',
                        'filter': 'brightness(1.2) drop-shadow(0 0 15px #00f0ff)'
                    },
                },
                'gothic-pulse': {
                    '0%, 100%': { 
                        'opacity': '1',
                        'filter': 'brightness(1)'
                    },
                    '50%': { 
                        'opacity': '0.85',
                        'filter': 'brightness(1.1)'
                    },
                },
            },
        },
    },

    plugins: [forms],
};
