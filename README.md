# Authentication for laravel

This is a package for creating login forms and user authentication, as well as managing their access level in Laravel. This package helps you treat it as a JWT token as well as a session and also provides them to you as an API.

## Install via composer

Run the following command to pull in the latest version:
```bash
composer require jobmetric/authentication
```

### Add service provider

Add the service provider to the providers array in the config/app.php config file as follows:

```php
'providers' => [

    ...

    JobMetric\Authentication\Providers\AuthenticationServiceProvider::class,
]
```

### Publish the config
Copy the `config` file from `vendor/jobmetric/authentication/config/config.php` to `config` folder of your Laravel application and rename it to `authentication.php`

Run the following command to publish the package config file:

```bash
php artisan vendor:publish --provider="JobMetric\Authentication\Providers\AuthenticationServiceProvider" --tag="config"
```

You should now have a `config/authentication.php` file that allows you to configure the basics of this package.

### Publish Views

You can use predefined views in this package.

```php
php artisan vendor:publish --provider="JobMetric\Authentication\Providers\AuthenticationServiceProvider" --tag="views"
```

## Documentation
