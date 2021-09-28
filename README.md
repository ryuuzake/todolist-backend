Todolist Backend for WPPL 2021
===

How to install forget password system
---
[Documentation Link](https://laravel.com/docs/7.x/passwords)

1. Install `laravel/ui` package
```bash
composer require laravel/ui:2.x
```

2. Generate Reset Password Scaffolding from `laravel/ui` packages
```bash
php artisan ui vue --auth
```

3. Migrate database to include laravel/ui migration
```bash
php artisan migrate
```

4. Add Controller for forget password and reset password
```php
Route::post('forget-password', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('reset-password', 'Auth\ResetPasswordController@reset');
```

5. Endpoint requirement for forget-password
```curl
curl --location --request POST 'http://127.0.0.1:8000/auth/forget-password' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "email": "email@example.com"
}'
```

6. Endpoint requirement for reset-password
```curl
curl --location --request POST 'http://127.0.0.1:8000/auth/reset-password' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "email": "email@example.com",
    "password": "password",
    "password_confirmation": "password",
    "token": "3853d9e343afff7be833aa2c5cd5570dd258c14c3307aabdf41d91aae40fb8a5"
}'
```
