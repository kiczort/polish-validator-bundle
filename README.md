Symfony2 bundle with Polish validators 
==================================

[![License](https://img.shields.io/packagist/l/kiczort/polish-validator-bundle.svg)](https://packagist.org/packages/kiczort/polish-validator-bundle)
[![Version](https://img.shields.io/packagist/v/kiczort/polish-validator-bundle.svg)](https://packagist.org/packages/kiczort/polish-validator-bundle)
[![Build status](https://travis-ci.org/kiczort/polish-validator-bundle.svg)](http://travis-ci.org/kiczort/polish-validator-bundle)
[![Scrutinizer Quality Score](https://img.shields.io/scrutinizer/g/kiczort/polish-validator-bundle.svg)](https://scrutinizer-ci.com/g/kiczort/polish-validator-bundle/)

This is Symfony2 bundle with validators for Polish identification numbers like: PESEL, NIP, REGON and PWZ.
 
 
# Installation

The recommended way to install this library is
[Composer](http://getcomposer.org).

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
```

Next, run the Composer command to install the latest stable version:

```bash
php composer.phar require kiczort/polish-validator-bundle
```

Add bundle to AppKernel.php

```php
    public function registerBundles()
        {
            $bundles = array(
                ...
                new Kiczort\PolishValidatorBundle\KiczortPolishValidatorBundle(),
                ...
            );
            
            return $bundles;
        }
```

# Documentation

## Example of use PeselValidator:

There are PESEL numbers with errors in real word, so in case of this validator checksum checking is only for strict mode.
In case of none strict mode it checks length, used chars and correctness of date of birth.

```php
...
// src/AppBundle/Entity/Person.php
namespace AppBundle\Entity;

use KiczortPolishValidatorBundle\Validator\Constraints as KiczortAssert;

class Person
{
    /**
     * @KiczortAssert\Pesel(
     *     message = "The '{{ value }}' is not a valid PESEL number.",
     *     strict = true
     * )
     */
     protected $pesel;
}
```

## Example of use NipValidator:

```php
...
// src/AppBundle/Entity/Person.php
namespace AppBundle\Entity;

use KiczortPolishValidatorBundle\Validator\Constraints as KiczortAssert;

class Person
{
    /**
     * @KiczortAssert\Nip
     */
     protected $nip;
}
```

## Example of use RegonValidator:

```php
...
// src/AppBundle/Entity/Company.php
namespace AppBundle\Entity;

use KiczortPolishValidatorBundle\Validator\Constraints as KiczortAssert;

class Company
{
    /**
     * @KiczortAssert\Regon
     */
     protected $regon;
}
```

## Example of use PwzValidator:

PWZ means "licence to practise a profession" (pl. "prawo wykonywania zawodu"),
number given to doctors from NIL (polish Chamber of Physicians and Dentists).
Validator accepts also empty strings and nulls so you have to add "Assert/NotBlank" myself.


```php
...
// src/AppBundle/Entity/Company.php
namespace AppBundle\Entity;

use KiczortPolishValidatorBundle\Validator\Constraints as KiczortAssert;

class Doctor
{
    /**
     * @KiczortAssert\Pwz
     */
     protected $pwz;
}
```

# Bug tracking

[GitHub issues](https://github.com/kiczort/polish-validator-bundle/issues).
If you have found bug, please create an issue.


# MIT License

License can be found [here](https://github.com/kiczort/polish-validator-bundle/blob/master/LICENSE).

