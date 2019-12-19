faxity/anax-layout
======================

[![Build Status](https://travis-ci.com/iFaxity/anax-layout.svg?branch=master)](https://travis-ci.com/iFaxity/anax-layout)
[![Build Status](https://scrutinizer-ci.com/g/iFaxity/anax-layout/badges/build.png?b=master)](https://scrutinizer-ci.com/g/iFaxity/anax-layout/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/iFaxity/anax-layout/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/iFaxity/anax-layout/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/iFaxity/anax-layout/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/iFaxity/anax-layout/?branch=master)

An Anax module for a modern and simplified layout.

## Installation

To install the package using composer:

`composer require faxity/anax-layout`

Then after that you need to rsync over the `view/, and optionally the theme/ folders`:
Or if you use the `faxity/di-sorcery` as the DI manager, you can just add `faxity/anax-layout` to the sorcery config file.

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

## SCSS Theming

There is theming with default styles using SASS in the `theme/` folder of this module.
To use it include it like this:

```scss
// ./vendor assuming the main .scss file is in the root folder
@import './vendor/faxity/anax-layout/theme/theme';
```
