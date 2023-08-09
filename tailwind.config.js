/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./lib/**/*.php",
    "./view/**/*.php"
  ],
  theme: {
    extend: {},
  },
  darkMode: 'dark',
  plugins: [
    require("daisyui")
  ],
}
