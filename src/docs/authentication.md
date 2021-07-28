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
composer require fligno/user-management
```

#### 2. Publish resource file

```
php artisan vendor:publish --tag=auth --force
```

This will publish the ReactJS components to your `/resources/js` folder. We have to add the `--force` flag because it will override the default `bootstrap.js` file inside the `/resources/js`.

If you have a separate frontend, you can copy the published files into your frontend app.

Aside from the ReactJS components, this command will also publish the `config/frontend.php` file and the `tests` files.

#### 3. Install the dependencies

```
npm install && npm run dev
```

#### 4. Run the passport migrations & commands

This package also installs the Laravel Passport automatically so you need to run the following commands for the Laravel Passport to work.

```
php artisan migrate
```

```
php artisan passport:install
```

#### 5. Prepare your `User` model

Your user model should have the following:

- Implement the `Illuminate\Contracts\Auth\MustVerifyEmail` contract
- Use the `Laravel\Passport\HasApiTokens` trait
- Use the `Fligno\Auth\Traits\EmailNotifications` trait

```php
<?php

namespace App;

use Fligno\Auth\Traits\EmailNotifications;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use Notifiable;
    use EmailNotifications;
}
```

#### 6. Add `Passport::routes()` to your `AuthServiceProvider@boot`

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


#### 7. Replace the `/` route with this:

```php
Route::view('/', 'Auth::welcome');
```

This is an optional step. This is only to demonstrate a homepage with the authentication links.
