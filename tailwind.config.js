/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./componants/*.{php,js}",
  ],
  theme: {
    extend: {
      colors: {
        'light-grey' : '#edf0f3',
        'medium-grey' : '#69636e',
        'dark-grey' : '#3e3a3a'
      },
      width: {
        '128': '32rem',
      }
    },
  },
  plugins: [],
}
