<?php

namespace Feedtailor\Mocking;

use ReflectionClass;

class PropertyModifier
{
    protected $obj;

    /**
     * @param $obj
     * @return self
     */
    static public function create($obj)
    {
        return new self($obj);
    }

    /**
     * @param $obj
     */
    public function __construct($obj)
    {
        $this->obj = $obj;
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function modify($name, $value)
    {
        $refClass = new ReflectionClass(get_class($this->obj));

        if (!$refClass->hasProperty($name)) {
            throw new \InvalidArgumentException("unknown property {$name}.");
        }

        $refProperty = $refClass->getProperty($name);

        if ($refProperty->isPublic()) {
            $refProperty->setValue($this->obj, $value);
        } else {
            $refProperty->setAccessible(true);
            $refProperty->setValue($this->obj, $value);
            $refProperty->setAccessible(false);
        }

        return $this;
    }

    /**
     * @param array $values
     * @return $this
     */
    public function modifyAll(array $values)
    {
        foreach ($values as $name => $value) {
            $this->modify($name, $value);
        }

        return $this;
    }
}
