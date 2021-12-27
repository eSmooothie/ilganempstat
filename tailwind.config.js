// run: npx tailwindcss -i ./public_html/assets/css/input.css -o ./public_html/assets/css/output.css --watch
module.exports = {
  content: [
    "./app/views/**/*.php",
    "./public_html/assets/**/*.js",
  ],
  theme: {
    extend: {},
    fontSize: {
      'xxs': 'xx-small',
      'xs': 'x-small',
      'sm': '.875rem',
      'tiny': '.875rem',
      'base': '1rem',
      'lg': '1.125rem',
      'xl': '1.25rem',
      '2xl': '1.5rem',
      '3xl': '1.875rem',
      '4xl': '2.25rem',
      '5xl': '3rem',
      '6xl': '4rem',
      '7xl': '5rem',
    },
    fontFamily: {
      'sans': ['ui-sans-serif', 'system-ui'],
      'serif': ['ui-serif', 'Georgia'],
      'mono': ['ui-monospace', 'SFMono-Regular'],
      'display': ['Oswald'],
      'body': ['"Open Sans"'],
      'roboto' : ['"Roboto"'],
    },
  },
  plugins: [],
}