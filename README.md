Moking-PropertyModifier
=======================

A property modifier for Mock object.

[![Build Status](https://travis-ci.org/feedtailor/Moking-PropertyModifier?branch=master)](https://travis-ci.org/feedtailor/Moking-PropertyModifier)


Install
-----

feedtailor/mocking-property-modifier を composer.json に追加して、 `composer install` を実行します。

```json
{
  "require": {
    "feedtailor/mocking-property-modifier": "dev-master"
  }
}
```


Example
--------

```php
use Feedtailor\Mocking\PropertyModifier;

class ExampleClass
{
    protected $foo = 10;

    public function getFoo()
    {
        return $this->foo;
    }
}

$obj = new ExampleClass();

echo $obj->getFoo();  // 10

PropertyModifier::create($obj)->modify("foo", 42);

echo $obj->getFoo();  // 42
```


Methods
--------

### $modifier = new PropertyModifier($obj);

### $modifier = PropertyModifier::create($obj);

Create a new `$modifier` instance.


### $modifier->modify($name, $value);

modify a `$name` property to `$value`.


### $modifier->modifyAll($values);

modify properties by associative array `$values`.



License
--------

Licensed under the MIT License.
