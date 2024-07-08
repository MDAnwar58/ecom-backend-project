/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            screens: {
                "2lg": "1175px",
                "2md": "865px",
                xs: "575px",
                "2xs": "500px",
                "3xs": "425px",
                "4xs": "375px",
            },
        },
    },
    plugins: [require("flowbite/plugin")],
};
