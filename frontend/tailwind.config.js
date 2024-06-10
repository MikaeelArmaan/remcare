// tailwind.config.js

module.exports = {
  content: [
    './src/**/*.{js,jsx,ts,tsx}',  // Include JS, JSX, TS, TSX files in src folder
    './public/index.html',         // Include index.html file
  ],
  theme: {
    extend: {},  // Extend Tailwind CSS with custom styles if needed
  },
  plugins: [
    require('tailwindcss'),     // Include Tailwind CSS
    require('autoprefixer'),    // Include Autoprefixer
    // Add other Tailwind CSS plugins if necessary
  ],
};
