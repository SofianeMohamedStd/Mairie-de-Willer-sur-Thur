const colors = require('tailwindcss/colors')

module.exports = {
  purge: [],
  darkMode: 'class', // or 'media' or 'class'
  theme: {
    maxWidth: {
      '0': '0',
      '1/4': '25%',
      '1/3': '33%',
      '1/2': '50%',
      '2/3': '66%',
      '3/4': '75%',
      'full': '100%',
      'screen-sm': '640px',
      'screen-md': '768px',
      'screen-lg': '1024px',
      'screen-xl': '1366px',
      'screen-2xl': '1440px',
    },
    extend: {
      fontFamily: {
        'title': ['Maven Pro'],
        'text': ['Poppins'],
        'customSerif': ['Lora' , 'Times New Roman']
      },
      colors:{
        willerBlue: "#025990",
        willerGreen: "#579D20"
      },
    },
  },
  variants: {
  },
  plugins: [
    require('@tailwindcss/forms'),
  ]
}

//https://github.com/tailwindlabs/tailwindcss-forms
