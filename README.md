# Laravel Doctrine Data Fixtures

[![Continuous Integration](https://github.com/API-Skeletons/laravel-doctrine-data-fixtures/actions/workflows/continuous-integration.yml/badge.svg)](https://github.com/API-Skeletons/laravel-doctrine-data-fixtures/actions/workflows/continuous-integration.yml)
[![Code Coverage](https://codecov.io/gh/API-Skeletons/laravel-doctrine-data-fixtures/branch/main/graphs/badge.svg)](https://codecov.io/gh/API-Skeletons/laravel-doctrine-data-fixtures/branch/main)
[![PHP Version](https://img.shields.io/badge/PHP-8.0%2b-blue)](https://img.shields.io/badge/PHP-8.0%2b-blue)
[![Laravel Version](https://img.shields.io/badge/Laravel-8.x%2b-red)](https://img.shields.io/badge/Laravel-5.7%20to%208.x-red)
[![Total Downloads](https://poser.pugx.org/api-skeletons/laravel-doctrine-data-fixtures/downloads)](//packagist.org/packages/api-skeletons/laravel-doctrine-data-fixtures)
[![License](https://poser.pugx.org/api-skeletons/laravel-doctrine-data-fixtures/license)](//packagist.org/packages/api-skeletons/laravel-doctrine-data-fixtures)


Laravel has built-in support for 'seed' data.  In seed data, the classes
are not namespaced and many developers treat seed data as a one-time
import.  Seed data often uses auto-increment primary keys.  Perhaps
these notes are what differentiates seed data from Fixtures.

In my fixtures I want static primary keys and I want to be able to
re-run my fixtures at any time.  I want the data my fixtures populate
to be stored with my fixtures and I want to reference fixture values
though class constants within my code.

For instance, to validate a user has an ACL role the code may 
read:

```php
$acl->hasRole($user, 'admin');
```

but this use of strings in the code does not read well and may be
error-prone.  Instead of the above, I want my code to read

```php
use App\ORM\Fixture\RoleFixture;

$acl->hasRole($user, RoleFixture::admin);
```

This pattern is not possible with seed data because seed data does
not have namespaces.  So, this repository exists not only as an
alternative to Laravel seed data, but as a namespaced-integrated
tool for static database data.


Installation
------------

Run the following to install this library using [Composer](https://getcomposer.org/):

```bash
composer require api-skeletons/laravel-doctrine-data-fixtures
```

A `doctrine-data-fixtures.php` configuration file is required.  Publish the included config to your project:

```sh
php artisan vendor:publish --tag=config --provider="ApiSkeletons\Laravel\Doctrine\DataFixtures\ServiceProvider"
```


Configuration
-------------

Doctrine MongoDB, ORM and PHPCR are supported.  See the configuration file for details.

This example assumes `laravel-doctrine/orm` is installed and you'll be using fixtures
for ORM data:

```php
return [
    'default' => [  // This is the group name
        'entityManager' => EntityManager::class,
        'executor' => ORMExecutor::class,
        'purger' => ORMPurger::class,
        'fixtures' => [
            Fixture1::class,
            Fixture2::class,
        ],
    ],
];
```

### Fixture Groups

Modeled from [api-skeletons/doctrine-data-fixture](https://github.com/API-Skeletons/doctrine-data-fixture)
for Laminas, fixtures are organized into groups.  This organization allows
fixtures for specific modules, development faker data, different entity
managers, and so on.


Use
---

### List Fixtures

List all groups or list all fixtures for a group.

```sh
php artisan doctrine:data-fixtures:list [<group>]
```

The `<group>` is optional.


### Executing a Fixture Group through Artisan command

```sh
php artisan doctrine:data-fixtures:import <group> [--purge-with-truncate] [--do-not-append]
```

The `<group>` is required.

Append is the default option.  This is inversed with --do-not-append

Options:

`--purge-with-truncate` if specified will purge the object manager's tables before 
running fixtures for the ORMPurger only.

`--do-not-append` will delete all data in the database before running fixtures.


Executing a Fixture Group from code
---------------------------------

For unit testing or other times you must run your fixtures from within code,
follow this example:

```php
use use Doctrine\Common\DataFixtures\Loader;

$config = config('doctrine-data-fixtures')[$groupName];

$objectManager = app($config['objectManager']);
$purger        = app($config['purger']);
$executorClass = $config['executor'];
$loader        = new Loader();

foreach ($config['fixtures'] as $fixture) {
    $loader->addFixture($fixture);
}

$executor = new $executorClass($objectManager, $purger);
$executor->execute($loader->getFixtures());
```


Doctrine data-fixtures
----------------------

Be sure to read the documentation on the parent library
[doctrine/data-fixtures](https://github.com/doctrine/data-fixtures)
