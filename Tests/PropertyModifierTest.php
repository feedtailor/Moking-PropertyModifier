<?php

namespace Feedtailor\Mocking\Tests;

use Feedtailor\Mocking\PropertyModifier;

class ExampleClass
{
    public    $foo = 10;
    protected $bar = 20;
    private   $baz = 30;

    public function getFoo()
    {
        return $this->foo;
    }

    public function getBar()
    {
        return $this->bar;
    }

    public function getBaz()
    {
        return $this->baz;
    }
}

class PropertyModifierTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }


    /**
     * @test
     */
    public function modifyPublicProperty()
    {
        $obj = new ExampleClass();

        $this->assertEquals(10, $obj->getFoo());
        $this->assertEquals(10, $obj->foo);

        $value = "OK";

        PropertyModifier::create($obj)->modify("foo", $value);

        $this->assertEquals($value, $obj->getFoo());
        $this->assertEquals($value, $obj->foo);
    }

    /**
     * @test
     */
    public function modifyProtectedProperty()
    {
        $obj = new ExampleClass();

        $this->assertEquals(20, $obj->getBar());

        $value = "OK";

        PropertyModifier::create($obj)->modify("bar", $value);

        $this->assertEquals($value, $obj->getBar());
        $this->assertAttributeEquals($value, "bar", $obj);
    }

    /**
     * @test
     */
    public function modifyPrivateProperty()
    {
        $obj = new ExampleClass();

        $this->assertEquals(30, $obj->getBaz());

        $value = "OK";

        PropertyModifier::create($obj)->modify("baz", $value);

        $this->assertEquals($value, $obj->getBaz());
        $this->assertAttributeEquals($value, "baz", $obj);
    }


    /**
     * @test
     */
    public function modifyProperties()
    {
        $obj = new ExampleClass();

        $this->assertEquals(10, $obj->getFoo());
        $this->assertEquals(20, $obj->getBar());
        $this->assertEquals(30, $obj->getBaz());

        PropertyModifier::create($obj)->modifyAll(array(
            "foo" => 123,
            "bar" => 456,
            "baz" => 789
        ));

        $this->assertEquals(123, $obj->getFoo());
        $this->assertEquals(456, $obj->getBar());
        $this->assertEquals(789, $obj->getBaz());
    }
}
