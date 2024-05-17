
# Severe


> Avoid data type conflicts in PHP being more severe 


[TOC]


## Summary

This repository offers a collection of PHP classes that enforce strict data types, ensuring more reliable and maintainable code. By leveraging these classes, developers can reduce bugs, improve code readability, and enhance overall software quality.

## Requirements

This library requires PHP^8.3

## Installation

Install `Severe` using Composer:

```bash
composer require fonil/severe
```

## Supported Data Types

### Generic Data Types

`Severe` supports the following generic data types:

- [Array](#array)
- [Boolean](#boolean)
- [Closure](#closure)
- [Float](#float)
- [Integer](#integer)
- [Null](#null)
- [Object](#object)
- [String](#string)

#### Usage

##### Setters

`Severe` provides a static public method `set()` that validates the input and creates a data type instance when succeed.

> In case of invalid argument type a `TypeError` is thrown

```php
use Fonil\Severe\TypeString;
use Fonil\Severe\TypeBoolean;
use Fonil\Severe\TypeNull;

$string = TypeString::set($var);
$bool = TypeBoolean::set($flag);
$null = TypeNull::set($optional);
...
```

##### Getters

All `Severe` data type instances are `_invokable` classes so you can get the values as follow:

```php
$value = $string();
$flag = $bool();
$optional = $null();
...
```

### Ennumeration Classes

#### Currency

To handle valid currencies a backed enumeration class is provided called `Currency` which allows you to get the `name`, `symbol`, `code` and `decimals` for allowed currencies.

##### Usage

###### Examples

```php
use Fonil\Severe\Enums\Currency;

$currency = Currency::EUR;				
echo $currency->value;       // EUR
echo $currency->code();      // 978
echo $currency->name();      // Euro
echo $currency->decimals();  // 2

$currency = Currency::UYI;
echo $currency->value;       // UYI
echo $currency->code();      // 940
echo $currency->name();      // Uruguay Peso en Unidades Indexadas (URUIURUI)
echo $currency->decimals();  // 0

// Dynamic instantiation
$currency = Currency::from('TRY');
echo $currency->value;       // TRY
echo $currency->code();      // 949
echo $currency->name();      // Turkish Lira
echo $currency->decimals();  // 2
```

### Additional Data Types

#### Money

Additionally, `Severe` provides a custom data type to handle money entities. Those entities has two components:

- Amount: a float number indicating the amount of money
- Currency: a currency entity

##### Usage

###### Setters

All of those ways are supported and equivalents:

```php
use Fonil\Severe\Enums\Currency;
use Fonil\Severe\TypeFloat;
use Fonil\Severe\TypeMoney;

$money = TypeMoney::set(123.456, 'eur');
$money = TypeMoney::set(123.456, Currency::EUR);
$money = TypeMoney::set(TypeFloat::set(123.456), 'EUR');
$money = TypeMoney::set(TypeFloat::set(123.456), Currency::EUR);
```

###### Getters

```php
[$amount, $currency] = $money();

// $amount is an instance of TypeFloat
// $currency is an instance of Currency
```

###### Examples

```php
$money = TypeMoney::set(123.456789, 'EUR');
[$amount, $currency] = $money();
echo $amount();                  // 123.46
echo $currency->value;           // EUR

$money = TypeMoney::set(123.456789, 'CLF');
echo $money()[0]->__invoke();    // 123.4568
echo $money()[1]->decimals();    // 4
```


## Security Vulnerabilities

Please review our security policy on how to report security vulnerabilities:

**PLEASE DON'T DISCLOSE SECURITY-RELATED ISSUES PUBLICLY**

### Supported Versions

Only the latest major version receives security fixes.

### Reporting a Vulnerability

If you discover a security vulnerability within this project, please [open an issue here](https://github.com/fonil/severe/issues). All security vulnerabilities will be promptly addressed.

## License

The MIT License (MIT). Please see [LICENSE](./LICENSE) file for more information.
