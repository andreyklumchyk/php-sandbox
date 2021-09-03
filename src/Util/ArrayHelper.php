<?php

namespace Chat\Util;


/**
 * Provides helpful methods to work with arrays.
 */
class ArrayHelper
{
    /**
     * Returns first element of array.
     *
     * @param array $array   Array to get first element of.
     *
     * @return mixed   First array element.
     */
    public static function reset(array $array)
    {
        return reset($array);
    }

    /**
     * Returns last element of array.
     *
     * @param array $array   Array to get last element of.
     *
     * @return mixed   Last array element.
     */
    public static function end(array $array)
    {
        return end($array);
    }
}
