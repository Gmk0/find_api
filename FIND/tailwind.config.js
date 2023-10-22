import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */

function withOpacity(variableName) {
    return ({ opacityValue }) => {
        if (opacityValue !== undefined) {
            return `rgba(var(${variableName}), ${opacityValue})`
        }
        return `rgb(var(${variableName}))`
    }
};



module.exports = {
    darkMode: 'class',
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],

  theme: {
    extend: {
      keyframes: {
        'fade-in-down': {
          "from": {
            transform: "translateY(-0.75rem)",
            opacity: '0'
          },
          "to": {
            transform: "translateY(0rem)",
            opacity: '1'
          },
        },
      },
      animation: {
        'fade-in-down': "fade-in-down 0.2s ease-in-out both",
          "spin-slow": "spin 3s linear infinite",
          "extra-spin-slow": "spin 20s linear infinite"
      },
          fontFamily: {
              sans: ['Figtree', ...defaultTheme.fontFamily.sans],
          },
          textColor: {
              skin: {
                  base: withOpacity('--color-text-base'),
                  muted: withOpacity('--color-text-muted'),
                  inverted: withOpacity('--color-text-inverted'),
              }
          },
          backgroundColor: {
              skin: {
                  fill: withOpacity('--color-fill'),
                  'button-accent': withOpacity('--color-button-accent'),
                  'button-accent-hover': withOpacity('--color-button-accent-hover'),
                  'button-muted': withOpacity('--color-button-muted'),
              }
          },
          gradientColorStops: {
              skin: {
                  hue: withOpacity('--color-fill'),
              },
          },
    },
  },
    plugins: [require("@tailwindcss/forms"), require("daisyui")],
};
