# entityservice-zend-validator

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This library provides Zend\Validator support for the polderknowledge/entityservice library

## Install

Via Composer

``` bash
$ composer require polderknowledge/entityservice-zend-validator
```

## Usage

After you have configured the EntityService you can use the validators without further config: 

```php
namespace MyApp\InputFilter;

use PolderKnowledge\EntityService\Validator\EntityExists;
use Zend\InputFilter\InputFilter;
use PonyApp\Entity\Pony;

class PonyEditInputFilter extends InputFilter
{
    /**
     * Initializes the input filter.
     */
    public function init()
    {
        $this->add([
            'name' => 'ponyId',
            'validators' => [
                [
                    'name' => EntityExists::class, // or EntityNotExists
                    'options' => [
                        'entity' => Pony::class,
                        'field' => 'name', // defaults to id 
                    ],
                ],
            ],
        ]);
    }
}
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please report them via [HackerOne](https://hackerone.com/polderknowledge) 
instead of using the issue tracker or e-mail.

## Community

We have an IRC channel where you can find us every now and then. We're on the Freenode network in the
channel #polderknowledge.

## Credits

- [Polder Knowledge][link-author]
- [All Contributors][link-contributors]

## License

Please see [LICENSE.md][link-license] for the license of this application.

[ico-version]: https://img.shields.io/packagist/v/polderknowledge/entityservice-zend-validator.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/polderknowledge/entityservice-zend-validator/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/polderknowledge/entityservice-zend-validator.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/polderknowledge/entityservice-zend-validator.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/polderknowledge/entityservice-zend-validator.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/polderknowledge/entityservice-zend-validator
[link-travis]: https://travis-ci.org/polderknowledge/entityservice-zend-validator
[link-scrutinizer]: https://scrutinizer-ci.com/g/polderknowledge/entityservice-zend-validator/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/polderknowledge/entityservice-zend-validator
[link-downloads]: https://packagist.org/packages/polderknowledge/entityservice-zend-validator
[link-author]: https://polderknowledge.com
[link-contributors]: ../../contributors
[link-license]: LICENSE.md
