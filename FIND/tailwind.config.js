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

const colors = require('tailwindcss/colors');

const navyColor = {
    50: "#E7E9EF",
    100: "#C2C9D6",
    200: "#A3ADC2",
    300: "#697A9B",
    400: "#5C6B8A",
    450: "#465675",
    500: "#384766",
    600: "#313E59",
    700: "#26334D",
    750: "#222E45",
    800: "#202B40",
    900: "#192132",
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
          colors: {
              info: colors.sky["500"],
              accent: "#5f5af6",
              "accent-focus": "#4d47f5",
              navy: navyColor,
              secondary: colors.slate,
              fila: "#fcf9f6",
              find: colors.orange,
              danger: colors.rose,
              primary: colors.amber,
              success: colors.green,
              warning: colors.yellow,
          },
    },
  },
    plugins: [require("@tailwindcss/forms"), require("daisyui")],
};
