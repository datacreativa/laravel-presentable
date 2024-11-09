# Laravel Presentable

[![Total Downloads](https://img.shields.io/packagist/dt/datacreativa/laravel-presentable.svg?style=flat-square)](https://packagist.org/packages/datacreativa/laravel-presentable)
![GitHub Actions](https://github.com/datacreativa/laravel-presentable/actions/workflows/main.yml/badge.svg)

![Banner](https://banners.beyondco.de/Laravel%20Presentable.png?theme=light&packageManager=composer+require&packageName=datacreativa%2Flaravel-presentable&pattern=bubbles&style=style_1&description=Create+presenters+for+Eloquent+Models&md=1&showWatermark=1&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg)

This package allows the information to be presented in a different way by means of methods that can be defined in the model's presenter class.

## Installation

You can install the package via composer:

| Laravel | Version |
|---------|---------|
| 6, 7, 8 | 1.0.0   |
| 9       | 1.1.0   |
| 10      | 1.2.0   |
| 11      | 1.3.0   |

```bash
composer require datacreativa/laravel-presentable
```

## Usage

Use the `HasPresentable` trait in any Eloquent Model, you must also add the `$presenter` property.

```php

use App\Models\Presenters\UserPresenter;
use TheHiveTeam\Presentable\HasPresentable;

class User extends Model
{
    use HasPresentable;

    protected $presenter = UserPresenter::class;
}

```

You can generate a class presenter with this command:

```bash
php artisan make:presenter UserPresenter
```

In this class you can define any method, for example:

```php
namespace App\Models\Presenters;

use TheHiveTeam\Presentable\Presenter;

class UserPresenter extends Presenter
{
    public function name()
    {
        return ucwords($this->model->name);
    }
}
```

Now you have available the `present()` method in Eloquent Model.

```php
$user = (new User)->setAttribute('name', 'john doe');
$user->present()->name;
// John Doe
```

Enjoy it!

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

-   [Jonathan Zarate](https://github.com/zaratedev)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
