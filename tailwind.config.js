import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import animate from 'tailwindcss-animate';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                discord: '#7289DA',
                twitch: '#9146FF',
                xbox: '#107C10',
                playstation: '#000000',
                windows: '#0078D7',
                primary: '#007AFF',
                secondary: '#FF375F',
                accent: '#FFD700',
            },
        },
    },

    plugins: [forms, animate, typography],
    darkMode: 'class'
};
