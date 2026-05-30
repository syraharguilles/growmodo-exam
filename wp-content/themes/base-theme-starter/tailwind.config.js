/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.php',
    './template-parts/**/*.php',
    './blocks/**/*.php',
    './blocks/**/*.js',
    './inc/**/*.php',
    './assets/js/**/*.js'
  ],
  theme: {
    extend: {
      fontFamily: {
        body: ['Urbanist', 'sans-serif'],
        heading: ['Urbanist', 'sans-serif'],
        sans: ['Urbanist', 'sans-serif']
      }
    }
  },
  plugins: []
};
