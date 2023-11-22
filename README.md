# Small package untuk integrasi dengan aplikasi Finance yang lama 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/inisiatif/legacy-finance.svg?style=flat-square)](https://packagist.org/packages/inisiatif/legacy-finance)
[![PHPUnit](https://github.com/atInisiatifZakat/legacy-finance/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/atInisiatifZakat/legacy-finance/actions/workflows/run-tests.yml)
[![Laravel Pint](https://github.com/atInisiatifZakat/legacy-finance/actions/workflows/fix-php-code-style-issues.yml/badge.svg?branch=main)](https://github.com/atInisiatifZakat/legacy-finance/actions/workflows/fix-php-code-style-issues.yml)
[![Psalm](https://github.com/atInisiatifZakat/legacy-finance/actions/workflows/run-psalm-static-analyst.yml/badge.svg?branch=main)](https://github.com/atInisiatifZakat/legacy-finance/actions/workflows/run-psalm-static-analyst.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/inisiatif/legacy-finance.svg?style=flat-square)](https://packagist.org/packages/inisiatif/legacy-finance)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:```

```bash
composer require inisiatif/legacy-finance
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="legacy-finance-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="legacy-finance-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="legacy-finance-views"
```

## Usage

```php
$legacyFinance = new Inisiatif\Finance\LegacyFinance();
echo $legacyFinance->echoPhrase('Hello, Inisiatif\Finance!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Nuradiyana](https://github.com/nuradiyana)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
