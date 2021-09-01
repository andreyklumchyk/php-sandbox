<?php

/**
 * Initial memory limit is increased as far as Kahlan requires more memory
 * for performing JIT operations over large libraries like mPDF.
 */
ini_set('memory_limit', '512M');

/**
 * Disables debug mode by default to avoid debug-behaviour in tests
 * when it's not expected.
 */
\Chat\Conf::$isDebugMode = false;


/**
 * Returns value of protected property for given object or class.
 *
 * @param object|string $object  Object or name of class.
 * @param string $name           Name of property.
 *
 * @return mixed    Value of property.
 */
function getProtectedPropertyValue($object, $name)
{
    $prop = (new \ReflectionClass($object))->getProperty($name);
    $prop->setAccessible(true);
    return $prop->getValue($prop->isStatic() ? null : $object);
}

/**
 * Calls protected method for given object or class.
 *
 * @param object|string  $object   Object or name of class.
 * @param string $name             Name of method.
 * @param array  $args             List of arguments.
 *
 * @return mixed        Result of method.
 */
function callProtectedMethod($object, $name, $args = [])
{
    $method = (new \ReflectionClass($object))->getMethod($name);
    $method->setAccessible(true);
    return $method->invokeArgs($method->isStatic() ? null : $object, $args);
}
