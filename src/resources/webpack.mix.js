const mix = require('laravel-mix');
const path = require('path');

mix
    .js("resources/js/auth/login.js", "public/js").react() // Add this line of code
    .js("resources/js/auth/register.js", "public/js").react() // Add this line of code
    .js("resources/js/auth/verification.js", "public/js").react() // Add this line of code
    .js("resources/js/auth/forget-password.js", "public/js").react() // Add this line of code
    .js("resources/js/auth/reset-password.js", "public/js").react() // Add this line of code
    .js("resources/js/home.js", "public/js").react() // Add this line of code
    .js("resources/js/admin/app.js", "public/js/admin").react() // Add this line of code
    .js("resources/js/admin/pages/login.js", "public/js/admin").react(); // Add this line of code

mix.webpackConfig({
    resolve: {
        extensions: [".js", ".json", ".vue"],
        alias: {
            "~": path.join(__dirname, "resources/js/admin")
        }
    },
    output: {
        publicPath: "/",
        chunkFilename: "js/admin/[name].js"
    }
});
