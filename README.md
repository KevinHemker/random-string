# random-string

![License](https://img.shields.io/github/license/KevinHemker/random-string)
![PHP-Versions](https://img.shields.io/badge/PHP-8.0%20--%208.2-blue)
![Tests](https://img.shields.io/github/actions/workflow/status/KevinHemker/random-string/testing.yml?branch=develop&label=tests)
[![codecov](https://codecov.io/github/KevinHemker/random-string/branch/develop/graph/badge.svg?token=XAI5WPQFHH)](https://codecov.io/github/KevinHemker/random-string)
![Type-Coverage](https://shepherd.dev/github/KevinHemker/random-string/coverage.svg)
![Psalm-Level](https://shepherd.dev/github/KevinHemker/random-string/level.svg)

**random-string** is a service to create strings of jumbled chars easily. Some use cases:

  - coupon codes in web shops
  - hashes for one-time links/passwords
  - account codes

Some Features:

  - full customizable chars to use
  - presets of chars available (digits, BASE16, BASE32...)
  - No length limit
  - works well with frameworks like Symfony (dependency injection), or standalone

## Installation

Open a command console, enter your project directory and execute:

```console
$ composer require hemker/random-string
```

If you don't use Composer, give it a try. It's a reason Composer is the most used package manager for PHP! And it's easy to use. [See composer's web page](https://getcomposer.org/doc/00-intro.md) for more information.

Otherwise, download all source files of this project and include `src/` into your own project at best fitting place.


## Usage

Imagine you want to create a random string of length 6, containing digits only. All you need is to interact with one single class.

```PHP
use Hemker\RandomString\RandomStringGenerator;

$generator = new RandomStringGenerator('0123456789', 6);
$string = $generator->create();
// $string is now something random like '395174'

// and of course... you can change settings whenever you want
$generator->chars('abcdefghijklmnopqrstuvwxyz');
$generator->length(10);
```

Typing all allowed chars is boring, hard to read and error-prone? Of course! Use presets instead:
```PHP
use Hemker\RandomString\CharPreset;
use Hemker\RandomString\RandomStringGenerator

// same as above: CharPreset::LETTER_LOWER_CASE == [a-z]
$string = new RandomStringGenerator(CharPreset::LETTER_LOWER_CASE);
```

You have to create a lot of strings, like 500 voucher codes? Simple as that!
```PHP
use Hemker\RandomString\CharPreset;
use Hemker\RandomString\RandomStringGenerator;

$generator = new RandomStringGenerator(CharPreset::LETTER_UPPER_CASE, 8);
$arrayOfStrings = $generator->create(500);
```

> **Note**
>
> If a negative number or 0 is passed to `__construct()` or `length()` an exception is thrown (of type `Hemker\RandomString\Exception\InvalidArgumentException` which extends `\InvalidArgumentException`).

## Contributing

You'd like to see a feature? Or you found a bug? Awesome! Open source is fueled by everyone's pieces of improvements. Please feel free to create or comment an issue. Every contribution, no matter how small, is welcome!

You're a programmer? Perfect. Pull requests are appreciated! Note this hints:

  - This project uses some tools to ensure code quality. You can install them by running `phive.phar install`. This will download all needed phars to `./tools`
  - run ` ./tools/php-cs-fixer.phar fix` to ensure code style
  - run `./tools/psalm.phar` to check type coverage
  - run `./tools/phpunit.phar` to run all unit tests
