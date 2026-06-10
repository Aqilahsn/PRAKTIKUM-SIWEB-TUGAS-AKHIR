import type { Config } from "tailwindcss";

const config: Config = {
  content: [
    "./src/pages/**/*.{js,ts,jsx,tsx,mdx}",
    "./src/components/**/*.{js,ts,jsx,tsx,mdx}",
    "./src/app/**/*.{js,ts,jsx,tsx,mdx}",
  ],
  theme: {
    extend: {
      colors: {
        sakura: {
          50: "#fff0f6",
          100: "#ffe0ed",
          200: "#ffb3d1",
          300: "#ff80b5",
          400: "#ff4d99",
          500: "#ff1a7d",
          600: "#e60066",
          700: "#b30050",
          800: "#800039",
          900: "#4d0023",
        },
        pink: {
          50: "#fdf2f8",
          100: "#fce7f3",
          200: "#fbcfe8",
          300: "#f9a8d4",
          400: "#f472b6",
          500: "#ec4899",
          600: "#db2777",
          700: "#be185d",
          800: "#9d174d",
          900: "#831843",
        },
        maroon: {
          50: "#fdf2f2",
          100: "#fde8e8",
          200: "#fbd5d5",
          300: "#f8b4b4",
          400: "#f17878",
          500: "#9b1c1c",
          600: "#8b1a1a",
          700: "#771515",
          800: "#5f1010",
          900: "#450b0b",
        },
        wine: {
          50: "#fdf4f5",
          100: "#fbe8ea",
          200: "#f5c6ca",
          300: "#ee9fa6",
          400: "#e37280",
          500: "#7b2d3f",
          600: "#6b2537",
          700: "#581e2d",
          800: "#451723",
          900: "#320f19",
        },
        dusty: {
          pink: "#d4a0a7",
          rose: "#c9787e",
          blush: "#e8b4b8",
          mauve: "#b8848a",
        },
        cream: "#faf5f0",
        rosegold: "#b76e79",
      },
      fontFamily: {
        sans: ["var(--font-inter)", "Inter", "sans-serif"],
        display: ["var(--font-playfair)", "Playfair Display", "serif"],
        mono: ["var(--font-jetbrains)", "JetBrains Mono", "monospace"],
      },
      backgroundImage: {
        "gradient-sakura":
          "linear-gradient(135deg, #fdf2f8 0%, #fce7f3 25%, #fbcfe8 50%, #f9a8d4 75%, #f472b6 100%)",
        "gradient-luxury":
          "linear-gradient(135deg, #9b1c1c 0%, #be185d 40%, #f472b6 80%, #fce7f3 100%)",
        "gradient-hero":
          "linear-gradient(135deg, #0a0006 0%, #1a0010 30%, #3d0020 60%, #7b1a3f 100%)",
        "gradient-card":
          "linear-gradient(135deg, rgba(251,207,232,0.15) 0%, rgba(244,114,182,0.1) 100%)",
      },
      animation: {
        float: "float 6s ease-in-out infinite",
        "float-slow": "float 10s ease-in-out infinite",
        "float-fast": "float 4s ease-in-out infinite",
        petal: "petal 8s linear infinite",
        "petal-slow": "petal 14s linear infinite",
        glow: "glow 2s ease-in-out infinite alternate",
        "spin-slow": "spin 20s linear infinite",
        shimmer: "shimmer 2s linear infinite",
        "pulse-pink": "pulse-pink 2s ease-in-out infinite",
        "slide-up": "slideUp 0.5s ease-out",
        "fade-in": "fadeIn 0.8s ease-out",
        marquee: "marquee 25s linear infinite",
        "marquee-reverse": "marqueeReverse 25s linear infinite",
      },
      keyframes: {
        float: {
          "0%, 100%": { transform: "translateY(0px)" },
          "50%": { transform: "translateY(-20px)" },
        },
        petal: {
          "0%": {
            transform: "translateY(-10px) rotate(0deg)",
            opacity: "1",
          },
          "100%": {
            transform: "translateY(110vh) rotate(720deg)",
            opacity: "0",
          },
        },
        glow: {
          from: { boxShadow: "0 0 20px rgba(244,114,182,0.3)" },
          to: { boxShadow: "0 0 60px rgba(244,114,182,0.8)" },
        },
        shimmer: {
          "0%": { backgroundPosition: "-200% 0" },
          "100%": { backgroundPosition: "200% 0" },
        },
        "pulse-pink": {
          "0%, 100%": { boxShadow: "0 0 20px rgba(244,114,182,0.4)" },
          "50%": { boxShadow: "0 0 60px rgba(244,114,182,0.8)" },
        },
        slideUp: {
          from: { transform: "translateY(30px)", opacity: "0" },
          to: { transform: "translateY(0)", opacity: "1" },
        },
        fadeIn: {
          from: { opacity: "0" },
          to: { opacity: "1" },
        },
        marquee: {
          "0%": { transform: "translateX(0%)" },
          "100%": { transform: "translateX(-50%)" },
        },
        marqueeReverse: {
          "0%": { transform: "translateX(-50%)" },
          "100%": { transform: "translateX(0%)" },
        },
      },
      backdropBlur: {
        xs: "2px",
      },
      boxShadow: {
        "pink-glow": "0 0 30px rgba(244,114,182,0.4)",
        "maroon-glow": "0 0 30px rgba(155,28,28,0.4)",
        "sakura-glow": "0 0 20px rgba(249,168,212,0.5)",
        glass:
          "0 8px 32px 0 rgba(244, 114, 182, 0.15), inset 0 1px 0 rgba(255,255,255,0.1)",
      },
    },
  },
  plugins: [],
};
export default config;
