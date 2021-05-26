// postcss.config.js
module.exports = {
    plugins: [
        require('tailwindcss'),
        require('postcss-nested'),
        require('autoprefixer'),
    ],
    tailwindcss: {},
    autoprefixer: {},
}
