# CryptoAddressValidator

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]


Adds a Laravel validator for various cryptocurrency address formats. 

Currently adds a `onion` and `bitcoin` validator. Planning to add the following soon:

* Dash addresses
* Dogecoin addresses
* Ethereum addresses (only very basic)
* Litecoin addresses
* Monero addresses

Also planning to create the following validators under another project

* GPG pubkey
* GPG signed data
* Generic Base38 Validator
* Generic Base32 Validator
* Generic Hex validator
* vinkla/laravel-hashids validator
* CC validator (Luhn digit check algorithm)

## Install

Via Composer

``` bash
$ composer require DeftNerd/CryptoAddressValidator
```

Add the following to the providers array in your config/app.php file
``` bash
DeftNerd\CryptoAddressValidator\CryptoAddressServiceProvider::class
```

## Usage


### Test any onion address to see if it follows the format
Base32, 16 characters, ends in '.onion'

Validator::make(['test' => 'facebookcorewwwi.onion'], ['test' => 'onion'])->passes(); //true

Validator::make(['test' => 'notarealonionaddress.onion'], ['test' => 'onion'])->passes(); //false

Validator::make(['test' => 'facebook.com'], ['test' => 'onion'])->passes(); //false

### Test a Bitcoin address to see if it's valid. 
Checks for proper Base58 encoding, tests the checksum, verifies the network prefix byte is one of (mainnet regular, mainnet p2sh, testnet regular, testnet p2sh)

Validator::make(['test' => '1HB5XMLmzFVj8ALj6mfBsbifRoD4miY36v'], ['test' => 'bitcoin'])->passes(); // true *(Bitcoin address)*

Validator::make(['test' => 'n2eMqTT929pb1RDNuqEnxdaLau1rxy3efi'], ['test' => 'bitcoin'])->passes(); // true *(Bitcoin Testnet address)*

Validator::make(['test' => 'jsd8j8jksdjf9sj98'], ['test' => 'bitcoin'])->passes(); // false *(random characters)*

Validator::make(['test' => 'LQ3B36Yv2rBTxdgAdYpU2UcEZsaNwXeATk'], ['test' => 'bitcoin'])->passes(); // false *(Litecoin address)*

## Security

If you discover any security related issues, please email adam@deftnerd.com instead of using the issue tracker.

## Credits

- [Adam Brown][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/DeftNerd/CryptoAddressValidator.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/DeftNerd/CryptoAddressValidator/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/DeftNerd/CryptoAddressValidator.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/DeftNerd/CryptoAddressValidator.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/DeftNerd/CryptoAddressValidator.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/DeftNerd/CryptoAddressValidator
[link-travis]: https://travis-ci.org/DeftNerd/CryptoAddressValidator
[link-scrutinizer]: https://scrutinizer-ci.com/g/DeftNerd/CryptoAddressValidator/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/DeftNerd/CryptoAddressValidator
[link-downloads]: https://packagist.org/packages/DeftNerd/CryptoAddressValidator
[link-author]: https://github.com/DeftNerd
[link-contributors]: ../../contributors
