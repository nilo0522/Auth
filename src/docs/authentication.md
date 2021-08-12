# Laravel Auth

This package handles your laravel project's api authentication. The following routes are already prepared for your project.

```$xslt
POST /api/register
POST /api/login
POST /api/logout
POST /api/password/email
POST /api/password/reset
GET  /api/email/resend
GET  /api/email/verify/{id}/{hash}
GET  /api/me
```

# Installation

#### 1. Install via composer

```
composer install
```

#### 2. Publish resource file

```
php artisan vendor:publish --tag=auth 
```

This will publish the ReactJS components to your `/resources/js` folder. We have to add the `--force` flag because it will override the default `bootstrap.js` file inside the `/resources/js`.

If you have a separate frontend, you can copy the published files into your frontend app.

Aside from the ReactJS components, this command will also publish the `config/frontend.php` file and the `tests` files.

#### 3. Add the published files to `webpack.mix.js`

```js
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
  .js("resources/js/admin/pages/login.js", "public/js/admin").react()

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
```

#### 4. Add `package.json` dependecies

```json
"devDependencies": {
        "@babel/preset-react": "^7.0.0",
        "axios": "^0.21",
        "js-cookie": "^2.2.1",
        "laravel-mix": "^6.0.27",
        "lodash.debounce": "^4.0.8",
        "postcss": "^8.3.1",
        "pretty-checkbox-react": "^1.1.0",
        "react": "^16.2.0",
        "react-dom": "^16.2.0",
        "react-router-dom": "^5.1.2",
        "resolve-url-loader": "^4.0.0",
        "sass": "^1.35.2",
        "sass-loader": "^12.1.0",
        "webpack": "^5.48.0"
    },
    "dependencies": {
        "@material-ui/core": "^4.12.3",
        "express": "^4.17.1",
        "laravel-echo": "^1.11.0",
        "pusher-js": "^7.0.3",
        "react-select": "^4.3.1",
        "react-select-2": "^2.0.11",
        "react-swal": "^3.0.0",
        "react-time-picker": "^4.3.0",
        "react-transition-group": "^2.3.0-beta.0",
        "select2-react-component": "^5.10.4",
        "socket.io": "^4.1.3",
        "sweetalert2": "^11.1.0",
        "webpack-cli": "^4.7.2"
    }
```

#### 5. Install the dependencies

```
npm install && npm run dev
```

#### 6. Run the passport migrations & commands

This package also installs the Laravel Passport automatically so you need to run the following commands for the Laravel Passport to work.

```
php artisan migrate
```

```
php artisan passport:install
```

#### 7. Prepare your `User` model

Your user model should have the following:

- Implement the `Illuminate\Contracts\Auth\MustVerifyEmail` contract
- Use the `Laravel\Passport\HasApiTokens` trait
- Use the `Fligno\Auth\Traits\EmailNotifications` trait

```php
<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasRoles;
    use HasApiTokens;
    use Notifiable;
    use EmailNotifications;
    use HasFactory;
```

#### 8. Add `Passport::routes()` to your `AuthServiceProvider@boot`

```php
/**
 * Register any authentication / authorization services.
 *
 * @return void
 */
public function boot()
{
    $this->registerPolicies();

    Passport::routes();
}
```

#### 9. Change your auth driver to `api` in your `config/auth.php`

```php

'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],

    'api' => [
        'driver' => 'passport', // change from 'api' to 'passport'
        'provider' => 'users',
    ],
],
```

#### 10. Replace the `/` route with this:

```php
Route::view('/', 'Auth::welcome');
```

This is an optional step. This is only to demonstrate a homepage with the authentication links.

#### 11. run php artisan db:seed RoleandPermission
