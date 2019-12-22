faxity/anax-layout
======================

[![Build Status](https://travis-ci.com/iFaxity/anax-layout.svg?branch=master)](https://travis-ci.com/iFaxity/anax-layout)
[![Build Status](https://scrutinizer-ci.com/g/iFaxity/anax-layout/badges/build.png?b=master)](https://scrutinizer-ci.com/g/iFaxity/anax-layout/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/iFaxity/anax-layout/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/iFaxity/anax-layout/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/iFaxity/anax-layout/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/iFaxity/anax-layout/?branch=master)

An Anax module for a modern and simplified layout, also includes a nice flash DI module.

## Installation

To install the package using composer:

`composer require faxity/anax-layout`

Then after that you need to copy over the `view/`, `/config`, and optionally the `theme/` folders.
For example with rsync:

```bash
mkdir view/ && rsync -av vendor/faxity/anax-layout/view view/
mkdir theme && rsync -av vendor/faxity/anax-layout/theme/ theme/
```

Or if you use the [faxity/di-sorcery](https://packagist.org/packages/faxity/di-sorcery) as the DI manager, you can just add `faxity/anax-layout` to the sorcery config file.

Then you need to update the `config/page.php` file to use the layout.
The normal template can be substituted like this:

```php
"layout" => [
    "region" => "layout",
    // Change here to use your own templatefile as layout
    "template" => "faxity/layout/default",
    // ..rest
],
"views" => [
    [
        "region"   => "header-logo",
        "template" => "faxity/navbar/logo",
        // ..rest
    ],
    [
        "region"   => "header",
        "template" => "faxity/navbar/header",
        // ..rest
    ],
    [
        "region"   => "header-mobile",
        "template" => "faxity/navbar/responsive",
        // ..rest
    ],
    [
        "region"   => "footer",
        "template" => "faxity/columns/default",
        // ..rest
    ],
],
```



## Flash module

The builtin flash module can be used to show flash messages to the user.
Assuming the installation steps above have been followed correctly, it's already installed.
To use it just use:

```php
//$di is the di package manager in Anax
$di->flash->ok("ok message");
$di->flash->warn("warning message");
$di->flash->err("error message");

// The flash messages by default are set in the session for the next request
// However to set a flash message in the current request just set the second argument to true
$di->flash->ok("immediate ok message", true);
$di->flash->warn("immediate warning message", true);
$di->flash->err("immediate error message", true);
```



## SCSS Theming

There is theming with default styles using SASS in the `theme/` folder of this module.
To use it include it like this:

```scss
// ./vendor assuming the main .scss file is in the root folder
@import './vendor/faxity/anax-layout/theme/theme';
```



## Navbar javascript code

Javascripts for the navbar are not automatically loaded and needs to be copied over.
This can be done easily via i.e rsync:

```bash
rsync -av vendor/faxity/anax-layout/htdocs htdocs/
```
