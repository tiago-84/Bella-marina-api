/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    fontFamily:{
      'sans': ['ui-sans-serif', 'system-ui', 'Poppins']
    },
    extend: {},
  },
  plugins: [],
}

