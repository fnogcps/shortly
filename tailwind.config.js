module.exports = {
  content: ["./public/*.html", "./public/**/*.html"],
  darkMode: ["class"],
  theme: {
    container: (theme) => ({
      center: true,
    }),
    fontFamily: {
      sans: ["Poppins", "ui-sans-serif", "system-ui"],
    },
  },
  plugins: [require("daisyui")],
};
