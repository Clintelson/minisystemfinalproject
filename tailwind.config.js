/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.{html,js,php}',         
    './app/**/*.{html,js,php}',   
    './css/**/*.css', 
    './public/**/*.{php,html,js}', 
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

